<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class Session{
    
    /**
     * starts the session
     */
    public static function init(){
        // if no session exist, start the session
        if (session_id() == ''){
            session_start();
        }
    }
    
    public static function isExist(){
        if(session_id() == ''){
            return false;
        }
        
        return true;
    }
    
    /**
     * sets a specific value to a specific key of the session
     *
     * @param mixed $key key
     * @param mixed $value value
     */
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }
    
    /**
     * gets/returns the value of a specific key of the session
     *
     * @param mixed $key Usually a string, right ?
     * @return mixed the key's value or nothing
     */
    public static function get($key){
        if (isset($_SESSION[$key])){
            if (is_string($_SESSION[$key])) {
                // filter the value for XSS vulnerabilities
                Filter::XSSFilter($_SESSION[$key]);
                return $_SESSION[$key];
            } else{
                return $_SESSION[$key];
            }
        }
    }
    
    /**
     * adds a value as a new array element to the key.
     * useful for collecting error messages etc
     *
     * @param mixed $key
     * @param mixed $value
     */
    public static function add($key, $value){
        $_SESSION[$key][] = $value;
    }
    
    /**
     * deletes the session (= logs the user out)
     */
    public static function destroy(){
        session_destroy();
    }
    
    /**
     * Checks if the user is logged in or not
     *
     * @return bool user's login status
     */
    public static function userIsLoggedIn(){
        return (self::get('user_logged_in') ? true : false);
    }
}
