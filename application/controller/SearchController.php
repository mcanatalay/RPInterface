<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class SearchController extends Controller{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
        Auth::checkAuthentication();
    }
    
    public function index(){
        $this->View->renderWithAll('search/index', array(
                        'keyword' => Request::post('search'),
                        'here' => Request::post('here')
                        )
                    );
    }
    
    public function games(){
        View::render('game/games', array(
                        'games' => SearchModel::getGamesByKeyword(Request::post('search'),
                                Request::post('result_limit'), Request::post('result_page'),
                                    Request::post('sort')),
                        'here' => Request::post('here')
                        )
                    );
    }
    
    public function users(){
        View::render('search/users', array(
                        'users' => SearchModel::getUsersByKeyword(Request::post('search'),
                                Request::post('result_limit'), Request::post('result_page'),
                                    Request::post('sort')),
                        'here' => Request::post('here')
                        )
                    );
    }
 }