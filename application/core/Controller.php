<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class Controller{
    /** @var View View The view object */
    public $View;
    
    /**
     * Construct the (base) controller. This happens when a real controller is constructed, like in
     * the constructor of IndexController when it says: parent::__construct();
     */
    function __construct(){
        // always initialize a session
        Session::init();
        // user is not logged in but has remember-me-cookie ? then try to login with cookie ("remember me" feature)
        if (!Session::userIsLoggedIn() AND Request::cookie('remember_me')){
            header('location: ' . Config::get('URL') . 'login/loginWithCookie');
        }
        // create a view object to be able to use it inside a controller, like $this->View->render();
        $this->View = new View();
    }
}