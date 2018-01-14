<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class SearchModel{
    public static function getUsersByKeyword($keyword, $result_limit=1, $result_page=0, $order = 1){
        $database = Database::getFactory()->getConnection();
        $order = UserModel::shortUserList($order);
        $result_offset = $result_limit * $result_page;
        $sql = "SELECT user_id, user_role, user_name, user_active, user_avatar
                FROM users WHERE user_name LIKE :keyword ORDER BY ".$order." LIMIT ".$result_limit." OFFSET ".$result_offset."";
        $keyword = '%'.$keyword.'%';
        $query = $database->prepare($sql);
        $query->execute(array(':keyword' => $keyword));
        $users = array();
        
        foreach($query->fetchAll() as $user){
            $users[$user->user_id] = new stdClass();
            $users[$user->user_id]->user_id = $user->user_id;
            $users[$user->user_id]->user_name = $user->user_name;
            $users[$user->user_id]->user_info_name = UserModel::getUserInfoNameByUserID($user->user_id);
            $users[$user->user_id]->user_role = $user->user_role;
            $users[$user->user_id]->user_role_name = UserRoleModel::getRoleName($user->user_role);
            $users[$user->user_id]->user_avatar_link = AvatarModel::getPublicUserAvatarFilePathByUserId($user->user_id);
        }
        
        return $users;
    }
    
    public static function getNumberOfUserResult($keyword){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM users WHERE user_name LIKE :keyword";
        $keyword = '%'.$keyword.'%';
        $query = $database->prepare($sql);
        $query->execute(array(':keyword' => $keyword));
        
        return $query->fetchColumn();
    }
    
    public static function getGamesByKeyword($keyword, $result_limit=1, $result_page=0, $order = 1){
        $database = Database::getFactory()->getConnection();
        $order = GameModel::shortGameList($order);
        $result_offset = $result_limit * $result_page;
        $sql = "SELECT * FROM games WHERE game_name LIKE :keyword OR game_title LIKE :keyword
                        OR game_description LIKE :keyword  OR game_type LIKE :keyword ORDER BY ".$order." LIMIT ".$result_limit." OFFSET ".$result_offset."";
        $keyword = '%'.$keyword.'%';
        $query = $database->prepare($sql);
        $query->execute(array(':keyword' => $keyword));
        $games = array();
        
        foreach($query->fetchAll() as $game){
            $games[$game->game_id] = new stdClass();
            $games[$game->game_id] = $game;
            $games[$game->game_id]->game_master = UserModel::getUserNameByUserID($game->user_id);
            $games[$game->game_id]->game_img_link = GameModel::getGameImg($game->game_id);
        }
        
        return $games;
    }
    
    public static function getNumberOfGameResult($keyword){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT count(*) FROM games WHERE game_name LIKE :keyword OR game_title LIKE :keyword
                        OR game_description LIKE :keyword OR game_type LIKE :keyword";
        $keyword = '%'.$keyword.'%';
        $query = $database->prepare($sql);
        $query->execute(array(':keyword' => $keyword));
        
        return $query->fetchColumn();
    }
}