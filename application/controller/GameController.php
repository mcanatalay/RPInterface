<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class GameController extends Controller{
    
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->View->renderWithAll('game/index',array('games' => GameModel::getAllGames()));
    }
    
    public function games(){
        $game_country = Request::post('game_country');
        $game_city = Request::post('game_city');
        View::render('game/games', array(
                        'games' => GameModel::getLimitedGames(Request::post('game_status'),
                                        Request::post('game_limit'),Request::post('game_page'),
                                            Request::post('sort'), $game_country, $game_city),
                        'here' => Request::post('here')
                        )
                    );
    }
    
    public function user_games(){
        View::render('game/games', array(
                        'games' => GameModel::getAllGamesByUserID(Request::post('user_id')),
                        'here' => Request::post('here')
                        )
                    );
    }
    
    public function rss(){
        $this->View->render('game/rss',array('games' => GameModel::getAllGames()));
    }
    
    public function schedule(){
        View::render('game/schedule_items',array('week' => 
                            ScheduleModel::getWeeklyGameSchedule(Request::post('game_id'),
                                    Request::post('week_start'), Request::post('week_end')),
                            'week_start' => Request::post('week_start'),
                            'week_end' => Request::post('week_end'),
                            'here' => Request::post('here')
                    ));
    }
    
    public function game($game_name){
        $game = GameModel::getPublicInfoOfGameByGamename($game_name);
        if($game != null){
            $this->View->renderWithAll('game/game',array('game' => $game));
        } else{
            Redirect::home();
        }
    }
    
    public function newGame(){
        if(Auth::checkLogged()){
            $game_type = Request::post('game_type_listed');
            if($game_type == '0'){
                $game_type = Request::post('game_type_other');
            }
            $game_name = GameModel::newGame(Session::get('user_id'), Request::post('game_title'), $game_type,
                Request::post('game_capacity'), Request::post('game_description_source'));
            if(!$game_name){
                Redirect::home();
            } else{
                Redirect::to('game/game/'.$game_name);
            }
        } else{
            Redirect::home();
        }
    }
    
    public function joinGame(){
        if(Auth::checkLogged() && !GameModel::isGameArchived(Request::post('game_id'))){
            if(Request::post('request_type') == 1){
                if(!GameModel::isPlayer(Session::get('user_id'), Request::post('game_id')) && !GameModel::isGameFull(Request::post('game_id'))){
                    GameModel::joinGame(Session::get('user_id'), Request::post('game_id'));
                }
            } else if(Request::post('request_type') == 2){
                if(GameModel::isPlayer(Session::get('user_id'), Request::post('game_id'))){
                    GameModel::leaveGame(Session::get('user_id'), Request::post('game_id'));
                }            
            }
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
    
    public function subscribeGame(){
        if(Auth::checkLogged()){
            if(Request::post('subscribe_type') == 1 && !FeedModel::isSubscriber(Session::get('user_id'), 2, Request::post('game_id'))){
                FeedModel::addSubscription(Session::get('user_id'), 2, Request::post('game_id'));
            } else if(!GameModel::isPlayer(Session::get('user_id'), Request::post('game_id'))){
                FeedModel::deleteSubscription(Session::get('user_id'), 2, Request::post('game_id'));
            }
            Redirect::back(Request::post('here'));
        } else{
            Redirect::home();
        }
    }
    
    public function rateGame(){
        if(Auth::checkLogged() && !GameModel::isGameMaster(Session::get('user_id'), Request::post('game_id'))){
            $game_rating = GameModel::rateGame(Request::post('game_id'), Session::get('user_id'), Request::post('game_rate'));
            if($game_rating != false){
                echo $game_rating;
            } else{
                echo $game_rating;
            }
        } else{
            echo '0';
        }
    }
    
    public function verifyPlayer(){      
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'), Request::post('game_id')) && !GameModel::isGameArchived(Request::post('game_id'))){
            GameModel::verifyPlayer(Request::post('user_id'),
                    Request::post('game_id'), Request::post('player_verify'));
            Redirect::back(Request::post('redirect'));
        } else{
            //Add No Permission feedback
            Redirect::home();
        }    
    }
    
    public function changeThemeGame(){      
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'), Request::post('game_id'))){
            GameModel::setGameThemeStatus(Request::post('game_id'), Request::post('game_theme_active'));
            Redirect::back(Request::post('redirect'));
        } else{
            //Add No Permission feedback
            Redirect::home();
        }    
    }
    
    public function deleteGame(){        
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'), Request::post('game_id'))){
            GameModel::deleteGame(Request::post('game_id'));
            Redirect::back(Request::post('redirect'));
        } else{
            //Add No Permission feedback
            Redirect::home();
        }    
    }
    
    public function archiveGame(){        
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'), Request::post('game_id'))){
            GameModel::archiveGame(Request::post('game_id'));
            Redirect::back(Request::post('redirect'));
        } else{
            //Add No Permission feedback
            Redirect::home();
        }    
    }
    
    public function activeGame(){        
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'), Request::post('game_id'))){
            GameModel::activeGame(Request::post('game_id'));
            Redirect::back(Request::post('redirect'));
        } else{
            //Add No Permission feedback
            Redirect::home();
        }    
    }
    
    public function editGameInfo(){
        $game_type = Request::post('game_type_listed');
        if($game_type == '0'){
            $game_type = Request::post('game_type_other');
        }
        
        $game_city = 0;
        $game_country = Request::post('game_country');
        if($game_country != '0'){
            $game_city = Request::post('game_city');
        }
                
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'), Request::post('game_id'))){
            GameModel::editGameInfo(Request::post('game_id'),
                    Request::post('game_title'), Request::post('game_capacity'), Request::post('game_level'),
                        $game_type, $game_country, $game_city);
            Redirect::back(Request::post('redirect'));
        } else{
            //Add No Permission feedback
            Redirect::home();
        }
    }
    
    public function editGameDescription(){
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'),  Request::post('game_id'))){
            GameModel::editGameDescription(Request::post('game_id'),
                                            Request::post('game_description_source'));
            Redirect::back(Request::post('redirect'));
        } else{
            //Add No Permission feedback
            Redirect::home();
        }
    }
    
    public function changeGameImg(){
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'),  Request::post('game_id'))){
            GameModel::setGameImg(Request::post('game_id'), Request::post('game_img'));
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
}