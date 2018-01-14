<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class Redirect{
    /**
     * To the homepage
     */
    public static function home(){
        header("location: " . Config::get('URL'));
    }
    
    /**
     * To the defined page
     *
     * @param $path
     */
    public static function to($path){
        header("location: " . Config::get('URL') . $path);
    }
    
    /**
     * To the defined page
     *
     * @param $path
     */
    public static function back($redirect){
        header("location: " . Config::get('URL') . ltrim(urldecode(Request::post('redirect')), '/'));
    }
    
    /**
     * Get current page which you wanted to redirect later
     *
     * @return $path
     */
    public static function get(){
        $get = urlencode(substr($_SERVER['REQUEST_URI'],strlen(Config::get('BASE_URL'))));
        $len = strpos($get,"%3F");
        if($len == 0){
            $len = strlen($get);
        }
        return substr($get,0,$len);
    }
}
