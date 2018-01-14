<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class CommentModel{
    
    /**
     * 
     * @param type $comment_id
     * @return type
     */
    public static function getCommentByCommentID($comment_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT post_id, from_id, comment_text_source,
                    comment_text, comment_creation_timestamp, comment_modified_timestamp
                        FROM comments WHERE comment_id = :comment_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':comment_id' => $comment_id));
        $comment = $query->fetch();
        if($query->rowCount() == 1){
            return $comment;
        }
        //ADD FEEDBACK HERE
        return null;
    }
    
    /**
     * 
     * @param type $post_id
     * @return type
     */
    public static function getNumberOfCommentsByPostID($post_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM comments WHERE post_id = :post_id";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id'=> $post_id));
        
        return $query->fetchColumn();
    }
        
    /**
     * 
     * @param type $post_id
     * @return \stdClass
     */
    public static function getAllCommentsByPostID($post_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT comment_id, from_id, comment_text_source,
                    comment_text, comment_creation_timestamp, comment_modified_timestamp
                        FROM comments WHERE post_id = :post_id
                            ORDER BY comment_creation_timestamp ASC";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id));
        
        $all_comments = array();
        
        foreach($query->fetchAll() as $comment){
            $all_comments[$comment->comment_id] = new stdClass();
            $all_comments[$comment->comment_id]->comment_id = $comment->comment_id;
            $all_comments[$comment->comment_id]->from_id = $comment->from_id;
            $all_comments[$comment->comment_id]->comment_text_source = $comment->comment_text_source;
            $all_comments[$comment->comment_id]->comment_text = $comment->comment_text;
            $all_comments[$comment->comment_id]->comment_creation_timestamp = $comment->comment_creation_timestamp;
            $all_comments[$comment->comment_id]->comment_modified_timestamp = $comment->comment_modified_timestamp;
        }
        
        return $all_comments;
    }
    
    /**
     * 
     * @param type $post_id
     * @param type $last_comment_id
     * @return \stdClass
     */
    public static function getOffsetedCommentsByPostID($post_id,$last_comment_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT comment_id, from_id, comment_text_source,
                    comment_text, comment_creation_timestamp, comment_modified_timestamp
                        FROM comments WHERE post_id = :post_id AND comment_id > :last_comment_id
                            ORDER BY comment_creation_timestamp ASC";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id, ':last_comment_id' => $last_comment_id));
        
        $all_comments = array();
        
        foreach($query->fetchAll() as $comment){
            $all_comments[$comment->comment_id] = new stdClass();
            $all_comments[$comment->comment_id]->comment_id = $comment->comment_id;
            $all_comments[$comment->comment_id]->from_id = $comment->from_id;
            $all_comments[$comment->comment_id]->comment_text_source = $comment->comment_text_source;
            $all_comments[$comment->comment_id]->comment_text = $comment->comment_text;
            $all_comments[$comment->comment_id]->comment_creation_timestamp = $comment->comment_creation_timestamp;
            $all_comments[$comment->comment_id]->comment_modified_timestamp = $comment->comment_modified_timestamp;
        }
        
        return $all_comments;
    }
    
    /**
     * 
     * @param type $post_id
     * @param type $comment_limit
     * @param type $comment_page
     * @return type
     */
    public static function getLimitedCommentsByPostID($post_id, $comment_limit=1, $comment_page=0){
        $database = Database::getFactory()->getConnection();
        //We are doing pagination.
        $comment_offset = $comment_page * $comment_limit;
        $sql = "SELECT comment_id, from_id, comment_text_source,
                    comment_text, comment_creation_timestamp, comment_modified_timestamp
                        FROM comments WHERE post_id = :post_id
                            ORDER BY comment_creation_timestamp ASC ".$comment_limit." OFFSET ".$comment_offset."";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id));
        
        $comments = array();
        
        foreach($query->fetchAll() as $comment){
            $comments[$comment->comment_id] = new stdClass();
            $comments[$comment->comment_id]->comment_id = $comment->comment_id;
            $comments[$comment->comment_id]->from_id = $comment->from_id;
            $comments[$comment->comment_id]->comment_text_source = $comment->comment_text_source;
            $comments[$comment->comment_id]->comment_text = $comment->comment_text;
            $comments[$comment->comment_id]->comment_creation_timestamp = $comment->comment_creation_timestamp;
            $comments[$comment->comment_id]->comment_modified_timestamp = $comment->comment_modified_timestamp;
        }
        
        return $comments;
    }
    
    public static function getCommentOwner($comment_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT from_id FROM comments WHERE comment_id = :comment_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':comment_id' => $comment_id));
        $comment = $query->fetch();

        if($query->rowCount() == 1){
            return $comment->from_id;
        }
        
        //ADD FEEDBACK HERE
        return null;
    }
    
    public static function getCommentPostOwner($comment_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT post_id FROM comments WHERE comment_id = :comment_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':comment_id' => $comment_id));
        $post_id = $query->fetch()->post_id;
        
        return PostModel::getPostOwner($post_id);
    }
    
    public static function newComment($post_id, $from_id, $comment_text_source){
        $comment_text = Text::bb_parse($comment_text_source);
        $comment_creation_timestamp = time();
        
        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO comments(post_id, from_id,
                    comment_text_source, comment_text, comment_creation_timestamp)
                        VALUES(:post_id, :from_id, 
                            :comment_text_source, :comment_text, :comment_creation_timestamp)";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id, ':from_id' => $from_id, 
            ':comment_text_source' => nl2br($comment_text_source), ':comment_text' => $comment_text, 
            ':comment_creation_timestamp' => $comment_creation_timestamp));
        
        $count = $query->rowCount();
        
        if($count == 1){
            if(!FeedModel::isSubscriber($from_id, 5, $post_id)){
                FeedModel::addSubscription($from_id, 5, $post_id);
            }
            FeedModel::pushNotification($from_id, $post_id, 5, "NEW_COMMENT");
            return true;
        }
        //Add Feedback for post error sent
        return false;
    }
        
    public static function deleteComment($comment_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM comments WHERE comment_id = :comment_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':comment_id' => $comment_id));
        
        $count = $query->rowCount();
        
        if($count == 1){
            //Add Feedback for comment successfuly deleted
            return true;
        }
        //Add Feedback for post comment deleted
        return false;
    }
    
    public static function deleteAllCommentsByPostID($post_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM comments WHERE post_id = :post_id";
        $query = $database->prepare($sql);
        $query->execute(array(':post_id' => $post_id));

        if($query->rowCount() == 1){
            //Add Feedback for comments successfuly deleted
            return true;
        }
        //Add Feedback for comments error deleted
        return false;
    }
    
    public static function isCommentedToPost($user_id, $post_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM comments WHERE user_id = :user_id AND
                     post_id= :post_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':post_id' => $post_id));

        if($query->fetchColumn() > 0){
            return true;
        }
    
        return false;
    }
        
}
