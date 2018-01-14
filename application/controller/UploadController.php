<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class UploadController extends Controller{
    
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function gallery(){
        View::render('others/gallery',array(
                            'master_type' => Request::post('master_type'),
                            'master_id' => Request::post('master_id')
        ));
    }
    
    public function files(){
        View::render('others/files',array(
                'files' => UploadModel::getAllFilesByType(Request::post('master_type'), Request::post('master_id'), Request::post('file_type')),
                'master_type' => Request::post('master_type'),
                'master_id' => Request::post('master_id'))
                );
    }
    
    public function imgUpload(){
        if(Auth::checkLogged()){
            $file_url = UploadModel::uploadImg(Request::files('img'), Session::get('user_id'));
            echo $file_url;
        } else{
            echo '';
        }
    }
    
    public function upload(){
        if(Auth::checkLogged() && ( (Request::post('master_type') == 1 && Auth::checkSelf(Request::post('master_id'))) || (Request::post('master_type') == 2 && GameModel::isVerifiedPlayer(Session::get('user_id'),Request::post('master_id'))) ) ){
            UploadModel::uploadFile(Request::files('file'), Session::get('user_id'), Request::post('master_type'), Request::post('master_id'));
        } else{
            Redirect::home();
        }
    }
    
    public function deleteFile(){
        $file_info = UploadModel::getFileData(Request::post('file_id'));
        if( Auth::checkLogged() && ( ($file_info->master_type == 1 && Auth::checkSelf($file_info->user_id)) || ($file_info->master_type == 2 && (Auth::checkSelf($file_info->user_id) || GameModel::isGameMaster(Session::get('user_id'), $file_info->master_id)) ) ) ){
            UploadModel::deleteFile(Request::post('file_id'));
        } else{
            Redirect::home();
        }
    }
    
}