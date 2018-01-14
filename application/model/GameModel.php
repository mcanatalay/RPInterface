<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class GameModel{
    
    public static function getAllGames(){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM games ORDER BY game_creation_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute();
        $games = array();
        
        foreach($query->fetchAll() as $game){
            $games[$game->game_id] = new stdClass();
            $games[$game->game_id] = $game;
            $games[$game->game_id]->game_master = UserModel::getUserNameByUserID($game->user_id);
            $games[$game->game_id]->game_img_link = self::getGameImg($game->game_id);
        }
        
        return $games;
    }
    
    public static function getAllGamesForNav($user_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT game_id FROM
                    games WHERE user_id = :user_id ORDER BY game_creation_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $result = $query->fetchAll();
        
        $sql = "SELECT game_id FROM
                    game_players WHERE user_id = :user_id AND player_status = :player_status ORDER BY player_register_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':player_status' => 1));

        $result = Application::mergeDistinctArrays($result, $query->fetchAll());
        $games = array();
        
        foreach($result as $game){
            $game_data = self::getPublicInfoOfGameByGameID($game->game_id);
            if($game_data->game_status == 0 || $game_data->game_status == 1){
                $games[$game->game_id] = new stdClass();
                $games[$game->game_id] = $game_data;
            }
        }
        
        return $games;
    }
       
    public static function getAllGamesByUserID($user_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT game_id FROM
                    games WHERE user_id = :user_id ORDER BY game_creation_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $result = $query->fetchAll();
        
        $sql = "SELECT game_id FROM
                    game_players WHERE user_id = :user_id AND player_status = :player_status ORDER BY player_register_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id, ':player_status' => 1));

        $result = Application::mergeDistinctArrays($result, $query->fetchAll());
        $games = array();
        
        foreach($result as $game){
            $game_data = self::getPublicInfoOfGameByGameID($game->game_id);
            if($game_data->game_status == 1 || $game_data->game_status == 2){
                $games[$game->game_id] = new stdClass();
                $games[$game->game_id] = $game_data;
            }
        }
        
        return $games;
    }
    
    public static function getLimitedGames($game_status=1, $game_limit=1, $game_page=0, $order = 1, $game_country = 0, $game_city = 0){
        $game_place = self::getGamePlace($game_country, $game_city);
        $database = Database::getFactory()->getConnection();
        $order = self::shortGameList($order);
        $game_offset = $game_page * $game_limit;
        $sql = "SELECT * FROM
                        games WHERE game_status = :game_status ".$game_place." ORDER BY ".$order." LIMIT ".$game_limit." OFFSET ".$game_offset."";
        $query = $database->prepare($sql);
        $query->execute(array(':game_status'=> $game_status));
        $games = array();
        
        foreach($query->fetchAll() as $game){
            $games[$game->game_id] = new stdClass();
            $games[$game->game_id] = $game;
            $games[$game->game_id]->game_master = UserModel::getUserNameByUserID($game->user_id);
            $games[$game->game_id]->game_img_link = self::getGameImg($game->game_id);
        }
        
        return $games;
    }
    
    public static function getNumberOfGames($game_status=1){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM games WHERE game_status = :game_status";
        $query = $database->prepare($sql);
        $query->execute(array(':game_status' => $game_status));
        
        return $query->fetchColumn();
    }
    
    public static function getPublicInfoOfGameByGamename($game_name){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM games WHERE game_name = :game_name LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_name' => $game_name));
        $game = $query->fetch();
        if($query->rowCount() == 1){
            $game->game_master = UserModel::getUserNameByUserID($game->user_id);
            $game->game_img_link = self::getGameImg($game->game_id);
            return $game;
        }
        return null;
    }
    
    public static function getPublicInfoOfGameByGameID($game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM games WHERE game_id = :game_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id));
        $game = $query->fetch();
        if($query->rowCount() == 1){
            $game->game_master = UserModel::getUserNameByUserID($game->user_id);
            $game->game_img_link = self::getGameImg($game->game_id);
            return $game;
        }
        return null;
    }    
    
    public static function getGameNameTitle($game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT game_name,game_title FROM games WHERE game_id = :game_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id));

        if($query->rowCount() == 1){
            return $query->fetch();
        }
        return null;
    } 
        
    public static function isPlayer($user_id, $game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT user_id, player_status FROM game_players WHERE game_id = :game_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':user_id' => $user_id));

        if($query->rowCount() == 1){
            return true;
        }

        if(self::isGameMaster($user_id, $game_id)){
            return true;
        }

        return false;
    }
    
    public static function isVerifiedPlayer($user_id, $game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT user_id, player_status FROM game_players WHERE game_id = :game_id AND user_id = :user_id AND player_status = 1 LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':user_id' => $user_id));

        if($query->rowCount() == 1){
            return true;
        }
        
        if(self::isGameMaster($user_id, $game_id)){
            return true;
        }
        
        return false;
    }
    
    public static function joinGame($user_id, $game_id){
        $player_register_timestamp = time();
        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO game_players (game_id, user_id, player_status, player_register_timestamp)
                    VALUES(:game_id, :user_id, :player_status, :player_register_timestamp)";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':user_id' => $user_id, ':player_status' => 0,
                                ':player_register_timestamp' => $player_register_timestamp));
        
        if($query->rowCount() == 1){
            if(!FeedModel::isSubscriber($user_id, 2, $game_id)){
                FeedModel::addSubscription($user_id, 2, $game_id);
            }
            FeedModel::addNotification(GameModel::getGameMaster($game_id), $user_id, 2, $game_id, "PLAYER_JOIN_REQUEST", time());
            return true;
        }
        
        return false;
    }
    
    public static function leaveGame($user_id, $game_id){
        $isVerified = self::isVerifiedPlayer($user_id, $game_id);
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM game_players WHERE game_id = :game_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':user_id' => $user_id));
        
        if($query->rowCount() == 1){
            if(FeedModel::isSubscriber($user_id, 2, $game_id)){
                FeedModel::deleteSubscription($user_id, 2, $game_id);
            }
            if($isVerified){
                FeedModel::pushNotification($user_id, $game_id, 2, "PLAYER_LEAVE");
            } else{
                FeedModel::addNotification(GameModel::getGameMaster($game_id), $user_id, 2, $game_id, "PLAYER_LEAVE", time());
            }
            return true;
        }
     
        return false;
    }    
    
    public static function verifyPlayer($user_id, $game_id, $player_status){
        $database = Database::getFactory()->getConnection();
        $sql = "UPDATE game_players SET player_status = :player_status WHERE
                                                game_id = :game_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':user_id' => $user_id, ':player_status' => $player_status));
        
        if($query->rowCount() == 1){
            if($player_status == 1){
                FeedModel::pushNotification($user_id, $game_id, 2, "PLAYER_JOIN");
            }
            FeedModel::addNotification($user_id, GameModel::getGameMaster($game_id), 2, $game_id, "PLAYER_VERIFY_".$player_status, time());
            return true;
        }
     
        return false;
    }
    
    public static function getGameTypes(){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM game_types ORDER BY type_name ASC";
        $query = $database->prepare($sql);
        $query->execute();
        $types = array();
        
        foreach($query->fetchAll() as $type){
            $types[$type->type_id] = new stdClass();
            $types[$type->type_id]->type_id = $type->type_id;
            $types[$type->type_id]->type_name = $type->type_name;
        }
        
        return $types;
    }
    
    public static function updateGameRate($game_id){
        $game_rate = (double) self::getGameRating($game_id);
        $database = Database::getFactory()->getConnection();
        $sql = "UPDATE games SET game_rate = :game_rate WHERE game_id = :game_id LIMIT 1";
        $query = $database->prepare($sql); 
        $query->execute(array(':game_id' => $game_id, 'game_rate' => $game_rate));
        if($query->rowCount() == 1){
            return $game_rate;
        }
        
        return false;
    }
    
    public static function getGameRating($game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT rate_value FROM game_rating WHERE game_id = :game_id";
        $query = $database->prepare($sql); 
        $query->execute(array(':game_id' => $game_id));
        $total = 0.0;
        foreach($query->fetchAll() as $rate){
            $total += (double) $rate->rate_value;
        }
        $avg = (double) $total/$query->rowCount();
        
        return round($avg,1);
    }
    
    public static function getBestGames($number = 3,$day = 7){
        $past = time() - $day*24*60*60;
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT game_id,rate_value FROM game_rating WHERE rate_timestamp >= :past";
        $query = $database->prepare($sql); 
        $query->execute(array(':past' => $past));
        
        $games = array();
        foreach($query->fetchAll() as $rate){
            if(!isset($games[$rate->game_id])){
                $games[$rate->game_id] = array();
                $games[$rate->game_id]['game_id'] = $rate->game_id;
                $games[$rate->game_id]['total'] = 0.0;
            }
            $games[$rate->game_id]['total'] += (double) $rate->rate_value;
        }
        
        $list = array_slice(Application::array_msort($games, array('total' => SORT_DESC)),0,$number);
        $bests = array();
        
        foreach($list as $game){
            $game_info = self::getPublicInfoOfGameByGameID($game['game_id']);
            if($game_info->game_status == 1){
                $bests[$game['game_id']] = new stdClass();
                $bests[$game['game_id']] = $game_info;
                $bests[$game['game_id']]->total = $game['total'];
            }
        }
        
        return $bests;
    }
    
    public static function rateGame($game_id, $user_id, $rate_value){
        $rate_timestamp = time();
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM game_rating WHERE game_id = :game_id AND user_id = :user_id";
        $query = $database->prepare($sql); 
        $query->execute(array(':game_id' => $game_id, ':user_id' => $user_id));
        
        $sql = "INSERT INTO game_rating (game_id, user_id, rate_value, rate_timestamp)
                    VALUES(:game_id, :user_id, :rate_value, :rate_timestamp)";
        $query = $database->prepare($sql); 
        $query->execute(array(':game_id' => $game_id, ':user_id' => $user_id,
                                ':rate_value' => $rate_value, 'rate_timestamp' => $rate_timestamp));
        return self::updateGameRate($game_id);
    }
    
    public static function getGamePlayers($game_id, $player_status){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT user_id, player_status FROM game_players WHERE game_id = :game_id AND player_status = :player_status";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':player_status' => $player_status));
        $players = array();
        
        foreach($query->fetchAll() as $player){
            $players[$player->user_id] = new stdClass();
            $players[$player->user_id]->user_id = $player->user_id;
            $players[$player->user_id]->user_name = UserModel::getUserNameByUserID($player->user_id);
            $players[$player->user_id]->user_avatar_link = AvatarModel::getPublicUserAvatarFilePathByUserId($player->user_id);
        }
        
        return $players;
    }
    
    public static function getNumberOfPlayers($game_id, $player_status){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM game_players WHERE game_id = :game_id AND player_status = :player_status";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':player_status' => $player_status));
        
        return $query->fetchColumn();
    }
    
    public static function isGameArchived($game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT game_status FROM games WHERE game_id = :game_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id));
        $result = $query->fetch()->game_status;
        
        if($query->rowCount() == 1){
            if($result == 1){
                return false;
            } else if($result == 2){
                return true;
            }
        }
        
        return false;
    }
    
    public static function isGameFull($game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT game_capacity FROM games WHERE game_id = :game_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id));
        $game_capacity = $query->fetch()->game_capacity;
        $player_number = self::getNumberOfPlayers($game_id,1);
        
        return (bool)((int) $game_capacity <= (int) $player_number);
    }
    
    public static function isGameMaster($user_id, $game_id){
        if($user_id == self::getGameMaster($game_id)){
            return true;
        }
        
        return false;
    }
    
    public static function getGameMaster($game_id){
        $database = Database::getFactory()->getConnection();
        //getting main data
        $sql = "SELECT user_id FROM games WHERE game_id = :game_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id));
        if($query->rowCount() == 1){
            return $query->fetch()->user_id;
        }
        return null;
    }
        
    public static function editGameDescription($game_id, $game_description_source){
        $game_description = Text::bb_parse($game_description_source);
        
        $database = Database::getFactory()->getConnection();
        $sql = "UPDATE games SET game_description_source = :game_description_source,
                    game_description = :game_description WHERE game_id = :game_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':game_description_source' => nl2br($game_description_source),
                                ':game_description' => $game_description));
        
        $count = $query->rowCount();
        
        if($count == 1){
            //Add Feedback for description successfuly modified
            return true;
        }
        //Add Feedback for description error modified
        return false;
    }
    
    public static function editGameInfo($game_id, $game_title, $game_capacity, $game_level, $game_type, $game_country, $game_city){
        if(strlen($game_title) > 64){
            return false;
        }
        
        if(self::saveGameInfo($game_id, $game_title, $game_capacity, $game_level, $game_type, $game_country, $game_city)){
            return true;
        }
        
        return false;
    }
    
    public static function saveGameInfo($game_id, $game_title, $game_capacity, $game_level, $game_type, $game_country, $game_city){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("UPDATE games SET game_title = :game_title, game_capacity = :game_capacity,
                                game_level = :game_level, game_type = :game_type, game_country = :game_country,
                                    game_city = :game_city WHERE game_id = :game_id LIMIT 1");
        $query->execute(array(':game_id' => $game_id, ':game_title' => $game_title, ':game_capacity' => $game_capacity,
                                ':game_level' => $game_level,':game_type' => $game_type, 'game_country' => $game_country, 'game_city' => $game_city));
        if($query->rowCount() == 1){
            return true;
        }
        return false;  
    }
    
    public static function setGameImg($game_id, $game_img){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("UPDATE games SET game_img = :game_img WHERE game_id = :game_id LIMIT 1");
        $query->execute(array(':game_id' => $game_id, ':game_img' => $game_img));
        if($query->rowCount() == 1){
            return true;
        }
        return false;
    }
    
    public static function getGameImg($game_id){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("SELECT game_img FROM games WHERE game_id = :game_id LIMIT 1");
        $query->execute(array(':game_id' => $game_id));
        if($query->rowCount() == 1){
            $data = $query->fetch();
            if($data->game_img != 0){
                return UploadModel::getPublicFilePathByFileId($data->game_img);
            } else{
                return Config::get('URL').Config::get('DEFAULT_GAME_IMG');
            }
           
        }
        return false;
    }
    
    public static function newGame($user_id, $game_title, $game_type, $game_capacity, $game_description_source){
        $game_name = self::checkGameName($game_title);
        $game_creation_timestamp = time();
        $game_description = Text::bb_parse($game_description_source);
        
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("INSERT INTO games (game_name, user_id, game_status, game_type,
                                        game_capacity, game_title, game_description_source, game_description,
                                        game_img, game_creation_timestamp)
                                    VALUES(:game_name, :user_id, :game_status, :game_type,
                                        :game_capacity, :game_title, :game_description_source, :game_description,
                                        :game_img, :game_creation_timestamp)");
        
        $query->execute(array(':game_name' => $game_name, ':user_id' => $user_id, ':game_status' => 0, ':game_type' => $game_type,
                                ':game_capacity' => $game_capacity, ':game_title' => $game_title,
                                ':game_description_source' => nl2br($game_description_source), ':game_description' => $game_description,
                                ':game_img' => '', ':game_creation_timestamp' => $game_creation_timestamp));
        
        $game_id = $database->lastInsertId();;
        
        if($query->rowCount() == 1){
            LineModel::newLine(2,$game_id,$user_id);
            FeedModel::addSubscription($user_id, 2, $game_id);
            FeedModel::pushNotification($user_id, $user_id, 1, "NEW_GAME");
            return $game_name;
        }
        
        return false;  
    }
    
    public static function checkGameName($game_title){
        $game_name = Functions::URL_safe(strtolower($game_title));
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("SELECT count(*) FROM games WHERE game_name = :game_name");
        $query->execute(array(':game_name' => $game_name));
        $number = $query->fetchColumn();
        if($number == 0){
            return $game_name;
        } else{
            return $game_name.'-'.($number+1);
        }
    }
    
    public static function deleteGame($game_id){
        $line_id = LineModel::getLineID(2, $game_id);
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("DELETE FROM games WHERE game_id = :game_id LIMIT 1");
        $query->execute(array(':game_id' => $game_id));
        
        if($query->rowCount() != 1){
            return false;
        }
        
        $query = $database->prepare("DELETE FROM game_players WHERE game_id = :game_id");
        $query->execute(array(':game_id' => $game_id));
        
        $query = $database->prepare("DELETE FROM game_rating WHERE game_id = :game_id");
        $query->execute(array(':game_id' => $game_id));
        
        LineModel::deleteLine($line_id);
        PostModel::deleteAllPostsByToID(2, $game_id);
        FeedModel::deleteAllSubscription(2, $game_id);
        ScheduleModel::deleteAllGameScheduleEvents($game_id);
        UploadModel::deleteAllFiles(2, $game_id);
        
        return true;
    }
    
    public static function archiveGame($game_id){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("UPDATE games SET game_status = :game_status WHERE game_id = :game_id LIMIT 1");
        $query->execute(array(':game_id' => $game_id, ':game_status' => 2));
        
        if($query->rowCount() != 1){
            return false;
        }
                
        return true;
    }
    
    public static function setGameThemeStatus($game_id, $game_theme_active){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("UPDATE games SET game_theme_active = :game_theme_active WHERE game_id = :game_id LIMIT 1");
        $query->execute(array(':game_id' => $game_id, ':game_theme_active' => $game_theme_active));
        
        if($query->rowCount() != 1){
            return false;
        }
                
        return true;
    }
    
     public static function activeGame($game_id){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("UPDATE games SET game_status = :game_status WHERE game_id = :game_id LIMIT 1");
        $query->execute(array(':game_id' => $game_id, ':game_status' => 1));
        
        if($query->rowCount() != 1){
            return false;
        }
                
        return true;
    }
    
    public static function getGamePlace($country_id, $city_id){
        if($country_id == 0){
            return '';
        }
        if($city_id == 0){
            return 'AND game_country = '.$country_id;
        }
        else{
            return 'AND game_country = '.$country_id.' AND game_city = '.$city_id;
        }
    }
    
    public static function shortGameList($short){
        if($short == 1){
            return 'game_title ASC';
        }
        if($short == -1){
            return 'game_title DESC';
        }
        if($short == 2){
            return 'game_creation_timestamp ASC';
        }
        if($short == -2){
            return 'game_creation_timestamp DESC';
        }
        if($short == 3){
            return 'game_rate DESC';
        }
        if($short == -3){
            return 'game_rate ASC';
        } else{
            return 'game_rate DESC';
        }
    }

}
