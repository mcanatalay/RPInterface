<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class LineController extends Controller{
    /**
     * Construct this object by extending the basic Controller class. The parent::__construct thing is necessary to
     * put checkAuthentication in here to make an entire controller only usable for logged-in users (for sure not
     * needed in the PostController).
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function line(){
        $line = LineModel::getLine(Request::post('master_type'), Request::post('master_id'));
        if($line->line_id != null){
            View::render('line/line', array(
                            'line' => $line,
                            'entries' => LineModel::getAllEntriesByLineID($line->line_id),
                            'here' => Request::post('here'))
                        );
        }
    }
    
    public function newEntry(){
        if(Auth::checkLogged() && LineModel::getLineOwner(Request::post('line_id')) == Session::get('user_id')){
            LineModel::newEntry(Request::post('line_id'),Request::post('entry_title'),
                                 Request::post('entry_text_source'), Request::post('entry_position'),
                                  Request::post('entry_ico'), Request::post('entry_color'));
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
    
    public function deleteEntry(){
        if(Auth::checkLogged() && LineModel::getEntryOwner(Request::post('entry_id')) == Session::get('user_id')){
            LineModel::deleteEntry(Request::post('entry_id'));
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
}