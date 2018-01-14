<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class IndexController extends Controller{
    
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index(){
        if(Auth::checkLogged()){
            $this->View->renderWithAll('index/index');
        } else{
            $this->View->renderWithAll('index/landing');
        }
    }
    
    public function terms(){
        $this->View->renderWithAll('index/terms');
    }
    
    public function ping(){
        $this->View->render('index/ping');
    }
    
    public function sitemap(){
        $this->View->render('index/sitemap',array('games' => GameModel::getAllGames(),
                                                   'users' => UserModel::getAllUsers()));
    }
    
    public function news(){
        View::render('index/news',array('news' => SiteModel::getAllNews(Request::post('news_limit'))));
    }
}