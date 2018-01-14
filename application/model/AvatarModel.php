<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class AvatarModel{
    
    public static function getPublicAvatarFilePathOfUser($user_avatar){
        if($user_avatar != 0){
            return UploadModel::getPublicFilePathByFileId($user_avatar);
        } else{
            return Config::get('URL') . Config::get('PATH_AVATARS_PUBLIC') . Config::get('AVATAR_DEFAULT_IMAGE');
        }
    }
    
    public static function setUserAvatar($user_id, $user_avatar){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("UPDATE users SET user_avatar = :user_avatar WHERE user_id = :user_id LIMIT 1");
        $query->execute(array(':user_id' => $user_id, ':user_avatar' => $user_avatar));
        if($query->rowCount() == 1){
            return true;
        }
        return false;
    }

    /**
     * Gets the user's avatar file path
     * @param $user_id integer The user's id
     * @return string avatar picture path
     */
    public static function getPublicUserAvatarFilePathByUserId($user_id){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("SELECT user_avatar FROM users WHERE user_id = :user_id LIMIT 1");
        $query->execute(array(':user_id' => $user_id));
        $user_avatar = $query->fetch()->user_avatar;
        
        return self::getPublicAvatarFilePathOfUser($user_avatar, $user_id);
    }
}