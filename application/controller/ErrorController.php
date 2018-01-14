<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class ErrorController extends Controller{
    
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Use this when something is not found. Gives back a proper 404 header response plus a normal page (where you could
     * show a well-designed error message or something more useful for your users).
     * You can see this in action in action in /core/Application.php -> __construct
     */
    public function error404(){
        header('HTTP/1.0 404 Not Found', true, 404);
        $this->View->render('error/404');
    }
    
    /**
     * This is just an experimental error 500 page.
     * TODO server should catch this page.
     */
    public function error500(){
        header('HTTP/1.0 500 Server Error', true, 500);
        $this->View->render('error/500');
    }
}