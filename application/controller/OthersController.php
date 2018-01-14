<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class OthersController extends Controller{
    /**
     * Construct this object by extending the basic Controller class. The parent::__construct thing is necessary to
     * put checkAuthentication in here to make an entire controller only usable for logged-in users (for sure not
     * needed in the PostController).
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function cities(){
        View::render('others/cities', array(
                        'cities' => Functions::getCities(Request::post('country_id')),
                        'selected' => Request::post('selected')));
    }
    
    public function feedbacks(){
        Auth::checkAuthentication();
        $this->View->renderWithAll('others/feedbacks', array(
                        'feedbacks' => Functions::getFeedbacks())
                );
    }
    
    public function newFeedback(){
        if(Auth::checkLogged()){
            Functions::addFeedback(Session::get('user_id'), Request::post('feedback_title'), Text::bb_parse(Request::post('feedback_text')));
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
}