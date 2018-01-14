<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class Social{
    
    public static function getFacebookAPI(){
        $fb = new Facebook\Facebook([
            'app_id' => Config::get('FACEBOOK_LOGIN_APP_ID'),
            'app_secret' => Config::get('FACEBOOK_LOGIN_APP_SECRET'),
            'default_graph_version' => 'v2.4',
        ]);
        
        return $fb;
    }
    
    public static function getFacebookUser(){
        $fb = new Facebook\Facebook([
            'app_id' => Config::get('FACEBOOK_LOGIN_APP_ID'),
            'app_secret' => Config::get('FACEBOOK_LOGIN_APP_SECRET'),
            'default_graph_version' => 'v2.4',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookSDKException $e){
          echo $e->getMessage();
          exit;
        }

        if (!isset($accessToken)){
            return null;
        }
        
        $fb_access_token = (string) $accessToken;
        
        try{
            $response = $fb->get('/me?fields=id,name', $fb_access_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e){
            return null;
        } catch(Facebook\Exceptions\FacebookSDKException $e){
            return null;
        }
        
        $user = $response->getGraphUser();
        
        return $user;
    }
    
    public static function getFacebookURL($url, $permissions){
        $fb = new Facebook\Facebook([
            'app_id' => Config::get('FACEBOOK_LOGIN_APP_ID'),
            'app_secret' => Config::get('FACEBOOK_LOGIN_APP_SECRET'),
            'default_graph_version' => 'v2.4',
        ]);
        
        $helper = $fb->getRedirectLoginHelper();
        
        $facebook_url = $helper->getLoginUrl($url,$permissions);
        
        return $facebook_url;
    }
}
