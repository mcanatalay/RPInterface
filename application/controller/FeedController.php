<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class FeedController extends Controller{
    
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function feed(){
        if(Auth::checkLogged()){
            View::render('post/posts',array(
                            'posts' => FeedModel::getFeed(Session::get('user_id'),Request::post('post_days')))
                    );
        }
    }


    public function notifications(){
        if(Auth::checkLogged()){
            View::render('feed/notifications',array(
                            'notifications' => FeedModel::getLimitedNotifications(Session::get('user_id'), Request::post('notification_limit')))
                    );
        }
    }
    
    public function notification_number(){
        if(Auth::checkLogged()){
            echo FeedModel::getNumberOfNotifications(Session::get('user_id'));
        }
        echo '';
    }
    
    public function notificationReaded(){
        if(Auth::checkLogged()){
            FeedModel::setNotificationReaded(Request::post('notification_id'));
        }
    }
}