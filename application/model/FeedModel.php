<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class FeedModel{
    
    public static function getAllSubscriptions($user_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM subscriptions WHERE user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $subscriptions = array();
        
        foreach($query->fetchAll() as $subscription){
            $subscriptions[$subscription->subscription_id] = new stdClass();
            $subscriptions[$subscription->subscription_id] = $subscription;
        }

        return $subscriptions;
    }
    
    public static function getSubscriptionsByType($user_id, $subscription_type){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM subscriptions WHERE user_id = :user_id AND subscription_type = :subscription_type";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':subscription_type' => $subscription_type));
        $subscriptions = array();
        
        foreach($query->fetchAll() as $subscription){
            $subscriptions[$subscription->subscription_id] = new stdClass();
            $subscriptions[$subscription->subscription_id] = $subscription;
        }

        return $subscriptions;
    }
    
    public static function getSubscription($subscription_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM subscriptions WHERE subscription_id = :subscription_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':subscription_id' => $subscription_id));
        
        if($query->rowCount() == 1){
            return $query->fetch();
        }

        return null;
    }
    
    public static function getSubscribers($subject_id, $subscription_type){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM subscriptions WHERE subject_id = :subject_id AND subscription_type = :subscription_type";
        $query = $database->prepare($sql);
        $query->execute(array(':subject_id' => $subject_id, ':subscription_type' => $subscription_type));
        $subscriptions = array();
        
        foreach($query->fetchAll() as $subscription){
            $subscriptions[$subscription->subscription_id] = new stdClass();
            $subscriptions[$subscription->subscription_id] = $subscription;
        }

        return $subscriptions;
    }
    
    public static function addSubscription($user_id, $subscription_type, $subject_id){
        $subscription_creation_timestamp = time();
        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO subscriptions (user_id, subscription_type, subject_id, subscription_creation_timestamp)
                    VALUES(:user_id, :subscription_type, :subject_id, :subscription_creation_timestamp)";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':subscription_type' => $subscription_type,
                                ':subject_id' => $subject_id, ':subscription_creation_timestamp' => $subscription_creation_timestamp));

        if($query->rowCount() == 1){
            if($subscription_type == 1){
                FeedModel::addNotification($subject_id, $user_id, 1, $user_id, "NEW_SUBSCRIPTION", time());
            }
            return true;
        }
    
        return false;
    }
    
    public static function deleteSubscription($user_id, $subscription_type, $subject_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM subscriptions WHERE user_id = :user_id AND
                    subscription_type = :subscription_type AND subject_id= :subject_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':subscription_type' => $subscription_type,
                                ':subject_id' => $subject_id));

        if($query->rowCount() == 1){
            return true;
        }
    
        return false;
    }
    
    public static function deleteAllSubscription($subscription_type, $subject_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM subscriptions WHERE subscription_type = :subscription_type AND subject_id = :subject_id";
        $query = $database->prepare($sql);
        $query->execute(array(':subscription_type' => $subscription_type,':subject_id' => $subject_id));

        self::deleteAllNotification($subscription_type, $subject_id);
        
        return true;
    }
       
    public static function isSubscriber($user_id, $subscription_type, $subject_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM subscriptions WHERE user_id = :user_id AND
                    subscription_type = :subscription_type AND subject_id= :subject_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':subscription_type' => $subscription_type,
                                ':subject_id' => $subject_id));

        if($query->fetchColumn() > 0){
            return true;
        }
    
        return false;
    }
    
    public static function isSubscribeEachOther($user_id, $subject_id){
        $first = self::isSubscriber($user_id, 1, $subject_id);
        $second = self::isSubscriber($subject_id, 1, $user_id);
        if($first && $second){
            return true;
        }
        
        return  false;
    }
    
    public static function addNotification($user_id, $from_id, $notification_type, $subject_id, $notification_token, $notification_creation_timestamp){
        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO notifications (user_id, from_id, notification_type, subject_id, notification_token, notification_creation_timestamp)
                    VALUES(:user_id, :from_id, :notification_type, :subject_id, :notification_token, :notification_creation_timestamp)";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':from_id' => $from_id, ':notification_type' => $notification_type, ':subject_id' => $subject_id,
                                ':notification_token' => $notification_token, ':notification_creation_timestamp' => $notification_creation_timestamp));
        if($query->rowCount() == 1){
            return true;
        }
        
        return false;
    }
    
    public static function pushNotification($from_id, $subject_id, $subscription_type, $notification_token){
        $notification_creation_timestamp = time();
        $subscribers = self::getSubscribers($subject_id, $subscription_type);
        
        foreach($subscribers as $subscriber){
            if($from_id != $subscriber->user_id){
                self::addNotification($subscriber->user_id, $from_id, $subscription_type, $subject_id, $notification_token, $notification_creation_timestamp);
            }
        }
        
        return true;
    }
    
    public static function getNotifications($user_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM notifications WHERE user_id = :user_id ORDER BY notification_creation_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $notifications = array();
        
        foreach($query->fetchAll() as $notification){
            $notifications[$notification->notification_id] = new stdClass();
            $notifications[$notification->notification_id] = $notification;
        }

        return $notifications;        
    }
    
    public static function getLimitedNotifications($user_id, $notification_limit=5){
        $limit = intval(1 * (int) $notification_limit);
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM notifications WHERE user_id = :user_id AND notification_status = :notification_status
                    ORDER BY notification_creation_timestamp DESC LIMIT ".$limit;
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':notification_status' => 0));
        $notifications = array();
        
        foreach($query->fetchAll() as $notification){
            $notifications[$notification->notification_id] = new stdClass();
            $notifications[$notification->notification_id] = $notification;
        }

        return $notifications;        
    }
    
    public static function setNotificationReaded($notification_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM notifications WHERE notification_id = :notification_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':notification_id' => $notification_id));
        
        if($query->rowCount() == 1){
            return true;
        }
        
        return false;  
    }
       
    public static function setNotificationStatus($notification_id, $notification_status){
        $database = Database::getFactory()->getConnection();
        $sql = "UPDATE notifications SET notification_status = :notification_status WHERE notification_id = :notification_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':notification_id' => $notification_id, ':notification_status' => $notification_status));
        
        if($query->rowCount() == 1){
            return true;
        }
        
        return false;
    }
    
    public static function getNumberOfNotifications($user_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM notifications WHERE user_id = :user_id AND notification_status = :notification_status";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':notification_status' => 0));
        
        return $query->fetchColumn();
    }
    
    public static function deleteAllNotification($notification_type, $subject_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM notifications WHERE notification_type = :notification_type AND subject_id= :subject_id";
        $query = $database->prepare($sql);
        $query->execute(array(':notification_type' => $notification_type,':subject_id' => $subject_id));

        return true;
    }
        
    public static function parseNotification($notification){
        $notification_text = null;
        $classes = array('NEW_COMMENT' => "fa fa-comment", "NEW_POST" => "fa fa-share", "PLAYER_VERIFY_1" => "fa fa-check",
            "PLAYER_VERIFY_0" => "fa fa-times", "PLAYER_JOIN_REQUEST" => "fa fa-plus", "PLAYER_JOIN" => "fa fa-arrow-right",
            "PLAYER_LEAVE" => "fa fa-arrow-left", "NEW_GAME" => "fa fa-flag", "NEW_LINE" => "fa fa-rss", "NEW_SUBSCRIPTION" => "fa fa-thumbs-up");
        
        if($notification->notification_type == 1){
            $user_name = UserModel::getUserNameByUserID($notification->subject_id);
            $notification_link = Config::get('URL').'profile/user/'.$user_name;
        } else if($notification->notification_type == 2){
            $game = GameModel::getGameNameTitle($notification->subject_id);
            $game_name = $game->game_name;
            $game_title = $game->game_title;
            $notification_link = Config::get('URL').'game/game/'.$game_name;
        } else if($notification->notification_type == 5){
            $notification_link = Config::get('URL').'post/post/'.$notification->subject_id;
        }
        
        if(strcasecmp($notification->notification_token, "PLAYER_JOIN_REQUEST") == 0){
            $notification_link .= "?settings";
        } else if(strcasecmp($notification->notification_token, "NEW_LINE") == 0){
            $notification_link .= "?line";
        }
        
        $notification_text = '<strong>'.UserModel::getUserNameByUserID($notification->from_id).'</strong>'.Text::get('NOTIFICATION_'.$notification->notification_token);
        if($notification->notification_type == 1 && strcasecmp($notification->notification_token, "NEW_GAME") != 0 && strcasecmp($notification->notification_token, "NEW_SUBSCRIPTION") != 0){
            $notification_text .= '<strong>'.$user_name.'</strong>';
        } else if($notification->notification_type == 2){
            $notification_text .= '<strong>'.$game_title.'</strong>';
        }
        $notification_text .= Text::get('NOTIFICATION_'.$notification->notification_token.'_POSFIX');
        $notification_img = AvatarModel::getPublicUserAvatarFilePathByUserId($notification->from_id);
        $notification_class= $classes[$notification->notification_token];
        
        $parsed = new stdClass();
        $parsed->class = $notification_class;
        $parsed->img = $notification_img;
        $parsed->text = $notification_text;
        $parsed->link = $notification_link;
        
        return $parsed;
    }
    
    public static function getFeed($user_id, $days = 10){
        $posts = array();
        foreach(self::getAllSubscriptions($user_id) as $element){
            if($element->subscription_type != 5){
                $posts = array_replace($posts,PostModel::getLastPostsByToID($element->subscription_type, $element->subject_id, $days));
            }
        }
        krsort($posts);
        
        return $posts;
    }
    
        
}
