<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class UserModel{

    public static function getAllUsers(){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT user_id, user_role, user_name, user_active, user_avatar,
                    user_creation_timestamp FROM users";
        $query = $database->prepare($sql);
        $query->execute();
        $users = array();
        
        foreach($query->fetchAll() as $user){
            $users[$user->user_id] = new stdClass();
            $users[$user->user_id]->user_id = $user->user_id;
            $users[$user->user_id]->user_name = $user->user_name;
            $users[$user->user_id]->user_info_name = UserModel::getUserInfoNameByUserID($user->user_id);
            $users[$user->user_id]->user_role = $user->user_role;
            $users[$user->user_id]->user_creation_timestamp = $user->user_creation_timestamp;
            $users[$user->user_id]->user_role_name = UserRoleModel::getRoleName($user->user_role);
            $users[$user->user_id]->user_avatar_link = AvatarModel::getPublicUserAvatarFilePathByUserId($user->user_id);
        }
        
        return $users;
    }
    
    /**
     * Gets a user's profile data, according to the given $user_name
     * @param $user_name string User's name
     * @return mixed The selected user's profile
     */
    public static function getPublicProfileOfUserByUsername($user_name){
        $database = Database::getFactory()->getConnection();
        //getting main data
        $sql = "SELECT user_id, user_role, user_name, user_email, user_active, user_avatar, user_deleted, user_facebook_active
                FROM users WHERE user_name = :user_name LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_name' => $user_name));
        $user = $query->fetch();
        if($query->rowCount() == 1){
            if(Config::get('USER_INFO_ACTIVE')){
                //if user exist we will collect side data
                $sql = "SELECT info_name, info_surname, info_birthday, info_gender, info_gsm,
                        info_country, info_city, info_town FROM user_info WHERE user_id = :user_id LIMIT 1";
                $query = $database->prepare($sql);
                $query->execute(array(':user_id' => $user->user_id));
                if($query->rowCount() == 1){
                    $user = (object) Application::mergeDistinctArrays($user,$query->fetch());
                }
            }
            $user->user_role_name = UserRoleModel::getRoleName($user->user_role);
            $user->user_avatar_link = AvatarModel::getPublicAvatarFilePathOfUser($user->user_avatar);
        } else{
            return null;
        }
                
        return $user;
    } 
   
    /**
     * Gets the user's data
     *
     * @param $user_name string User's name
     *
     * @return mixed Returns false if user does not exist, returns object with user's data when user exists
     */
    public static function getUserDataByUsername($user_name){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT user_id, user_name, user_email, user_password_hash, user_active,user_deleted, user_suspension_timestamp, user_role,
                       user_failed_logins, user_last_failed_login
                  FROM users
                 WHERE (user_name = :user_name OR user_email = :user_name)
                       AND user_provider_type = :provider_type
                 LIMIT 1";
        $query = $database->prepare($sql);
        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_name' => $user_name, ':provider_type' => 'DEFAULT'));
        // return one row (we only have one result or nothing)
        return $query->fetch();
    }
    
    
    /**
     * @param $user_name_or_email
     *
     * @return mixed
     */
    public static function getUserDataByUserNameOrEmail($user_name_or_email){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("SELECT user_id, user_name, user_email FROM users
                                     WHERE (user_name = :user_name_or_email OR user_email = :user_name_or_email)
                                           AND user_provider_type = :provider_type LIMIT 1");
        $query->execute(array(':user_name_or_email' => $user_name_or_email, ':provider_type' => 'DEFAULT'));
        return $query->fetch();
    }
    
    /**
     * Gets the user's data by user's id and a token (used by login-via-cookie process)
     *
     * @param $user_id
     * @param $token
     *
     * @return mixed Returns false if user does not exist, returns object with user's data when user exists
     */
    public static function getUserDataByUserIdAndToken($user_id, $token){
        $database = Database::getFactory()->getConnection();
        
        // get real token from database (and all other data)
        $query = $database->prepare("SELECT user_id, user_name, user_email, user_password_hash, user_active,
                                          user_role,  user_avatar, user_failed_logins, user_last_failed_login
                                     FROM users
                                     WHERE user_id = :user_id
                                       AND user_remember_me_token = :user_remember_me_token
                                       AND user_remember_me_token IS NOT NULL
                                       AND user_provider_type = :provider_type LIMIT 1");
        $query->execute(array(':user_id' => $user_id, ':user_remember_me_token' => $token, ':provider_type' => 'DEFAULT'));
        
        // return one row (we only have one result or nothing)
        return $query->fetch();
    }
    
    public static function getUserDataByFacebookUID($user_facebook_uid){
        $database = Database::getFactory()->getConnection();
        
        // get real token from database (and all other data)
        $query = $database->prepare("SELECT user_id, user_name, user_email, user_password_hash, user_active,
                                          user_role, user_avatar, user_failed_logins, user_last_failed_login
                                     FROM users
                                     WHERE user_facebook_uid = :user_facebook_uid
                                     AND user_facebook_active = :user_facebook_active LIMIT 1");
        $query->execute(array(':user_facebook_uid' => $user_facebook_uid, ':user_facebook_active' => 1));
        
        // return one row (we only have one result or nothing)
        return $query->fetch();
    }
    
    /**
     * Gets the user's id
     *
     * @param $user_name
     *
     * @return mixed
     */
    public static function getUserIdByUsername($user_name){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT user_id FROM users WHERE user_name = :user_name AND user_provider_type = :provider_type LIMIT 1";
        $query = $database->prepare($sql);
        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_name' => $user_name, ':provider_type' => 'DEFAULT'));
        // return one row (we only have one result or nothing)
        return $query->fetch()->user_id;
    }
    
    /**
     * Gets the user's name
     *
     * @param $user_id
     *
     * @return mixed
     */
    public static function getUserNameByUserID($user_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT user_name FROM users WHERE user_id = :user_id AND user_provider_type = :provider_type LIMIT 1";
        $query = $database->prepare($sql);
        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_id' => $user_id, ':provider_type' => 'DEFAULT'));
        // return one row (we only have one result or nothing)
        return $query->fetch()->user_name;
    }
    
    /**
     * Gets the user's info name
     * 
     * @param type $user_id
     * @return type
     */
    public static function getUserInfoNameByUserID($user_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT info_name, info_surname FROM user_info WHERE user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
        $data = $query->fetch();
        return $data->info_name.' '.$data->info_surname;    
    }
    
    /**
     * Checks if a username is already taken
     *
     * @param $user_name string username
     *
     * @return bool
     */
    public static function doesUsernameAlreadyExist($user_name){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("SELECT user_id FROM users WHERE user_name = :user_name LIMIT 1");
        $query->execute(array(':user_name' => $user_name));
        if($query->rowCount() == 0){
            return false;
        }
        return true;
    }
    
    /**
     * Checks if a email is already used
     *
     * @param $user_email string email
     *
     * @return bool
     */
    public static function doesEmailAlreadyExist($user_email){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("SELECT user_id FROM users WHERE user_email = :user_email LIMIT 1");
        $query->execute(array(':user_email' => $user_email));
        if($query->rowCount() == 1){
            return true;
        }
        return false;
    }
    
    public static function editUserInfo($user_id, $info_name,$info_surname,$info_birthday,$info_gender,$info_gsm){
        if(strlen($info_name) > 64){
            return false;
        }
        if(strlen($info_surname) > 64){
            return false;
        }
        if(strlen($info_gsm) > 13){
            return false;
        }
        
        if(self::saveNewUserInfo($user_id, $info_name, $info_surname, $info_birthday, $info_gender, $info_gsm)){
            return true;
        }
        
        return false;
    }
    
    public static function saveNewUserInfo($user_id,$info_name,$info_surname,$info_birthday,$info_gender,$info_gsm){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("UPDATE user_info SET info_name = :info_name,
                                info_surname = :info_surname, info_birthday = :info_birthday,
                                info_gender = :info_gender, info_gsm = :info_gsm WHERE user_id = :user_id LIMIT 1");
        $query->execute(array(':user_id' => $user_id, ':info_name' => $info_name, ':info_surname' => $info_surname,
                                ':info_birthday' => $info_birthday, ':info_gender' => $info_gender, ':info_gsm' => $info_gsm));
        if($query->rowCount() == 1){
            return true;
        }
        return false;  
    }
    
    public static function doesFacebookUserIDAlreadyExist($user_facebook_uid){
        $database = Database::getFactory()->getConnection();
        $query = $database->prepare("SELECT user_facebook_uid FROM users WHERE user_facebook_uid = :user_facebook_uid LIMIT 1");
        $query->execute(array(':user_facebook_uid' => $user_facebook_uid));
        if($query->rowCount() == 0){
            return false;
        }
        return true;
    }
       
    public static function shortUserList($short){
        if($short == 1){
            return 'user_name ASC';
        }
        if($short == -1){
            return 'user_name DESC';
        }
        if($short == 2){
            return 'user_creation_timestamp ASC';
        }
        if($short == -2){
            return 'user_creation_timestamp DESC';
        }
        if($short == 3){
            return 'user_role ASC';
        }
        if($short == -3){
            return 'user_role DESC';
        } else{
            return 'user_id DESC';
        }
    }
}
