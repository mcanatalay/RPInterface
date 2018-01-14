<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class ProfileController extends Controller{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * This method controls what happens when you move to /overview/showProfile in your app.
     * Shows the (public) details of the logged user.
     */
    public function index(){
        if(Auth::checkLogged()){
            Redirect::to('profile/user/'.SESSION::get('user_name'));
        } else{
            Redirect::home();
        }
    }
    
    /**
     * This method controls what happens when you move to /overview/showProfile in your app.
     * Shows the (public) details of the selected user.
     * @param $user_name string name the the user
     */
    public function user($user_name){
        if(isset($user_name)){
            $user = UserModel::getPublicProfileOfUserByUsername($user_name);
            if($user != null){
                $this->View->renderWithAll('profile/user', array(
                    'user' => $user)
                );
            } else{
                Redirect::home();
            }
        } else{
            Redirect::to('profile/user/'.SESSION::get('user_name'));
        }
    }
    
    public function subscribeUser(){
        if(Auth::checkLogged()){
            if(Request::post('subscribe_type') == 1 && !FeedModel::isSubscriber(Session::get('user_id'), 1, Request::post('user_id'))){
                FeedModel::addSubscription(Session::get('user_id'), 1, Request::post('user_id'));
            } else if(!Auth::checkSelf(Request::post('user_id'))){
                FeedModel::deleteSubscription(Session::get('user_id'), 1, Request::post('user_id'));
            }
            Redirect::back(Request::post('here'));
        } else{
            Redirect::home();
        }
    }
    
    public function editUserInfo(){
        if(Auth::checkLogged()){
            UserModel::editUserInfo(Session::get('user_id'),
                    Request::post('info_name'), Request::post('info_surname'), 
                        Request::post('info_birthday'), Request::post('info_gender'), Request::post('info_gsm'));
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
    
    public function changeUserAvatar(){
        if(Auth::checkLogged()){
            AvatarModel::setUserAvatar(Session::get('user_id'),Request::post('user_avatar'));
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
 }