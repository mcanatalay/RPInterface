<?php

class Auth{
    
    /**
     * The normal authentication flow, just check if the user is logged in (by looking into the session).
     * If user is not, then he will be redirected to login page and the application is hard-stopped via exit().
     */
    public static function checkAuthentication(){
        
        // initialize the session (if not initialized yet)
        Session::init();
        
        // if user is NOT logged in...
        // (if user IS logged in the application will not run the code below and therefore just go on)
        if (!Session::userIsLoggedIn()) {
            
            // ... then treat user as "not logged in", destroy session, redirect to login page
            Session::destroy();
            
            // send the user to the login form page, but also add the current page's URI (the part after the base URL)
            // as a parameter argument, making it possible to send the user back to where he/she came from after a
            // successful login
            Redirect::to('login?redirect=' . Redirect::get());
            
            // to prevent fetching views via cURL (which "ignores" the header-redirect above) we leave the application
            // the hard way, via exit(). @see https://github.com/panique/php-login/issues/453
            // this is not optimal and will be fixed in future releases
            exit();
        }
    }
    
    /**
     * Inherits checkAuthentication
     * The normal permission authentication flow, just check if the user is permitted or not.
     * If user is not permitted then he will be redirected to login page and the application is hard-stopped via exit().
     */
    public static function checkPermission($permission_name){
        
        self::checkAuthentication();
        
        if (!UserRoleModel::getUserPermission(Session::get('user_id'),$permission_name)) {
            
            Redirect::home();
            
            // to prevent fetching views via cURL (which "ignores" the header-redirect above) we leave the application
            // the hard way, via exit(). @see https://github.com/panique/php-login/issues/453
            // this is not optimal and will be fixed in future releases
            exit();
        }
    }
    
    /**
     * 
     * @return boolean
     */
    public static function checkLogged(){
        if(Session::isExist()){
            return Session::userIsLoggedIn();
        } else{
            return false;
        }
    }


    /**
     * 
     * @param type $user_id
     * @return boolean
     */
    public static function checkSelf($user_id){
        if($user_id == Session::get('user_id')){
            return true;
        }
        
        return false;
    }
}