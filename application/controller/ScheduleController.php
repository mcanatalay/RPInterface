<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class ScheduleController extends Controller{
    
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function game(){
        View::render('schedule/game',array('week' => 
                            ScheduleModel::getWeeklyGameSchedule(Request::post('game_id'),
                                    Request::post('week_start'), Request::post('week_end')),
                            'week_start' => Request::post('week_start'),
                            'week_end' => Request::post('week_end'),
                            'here' => Request::post('here')
                    ));
    }
    
    public function newGameEvent(){
        if(Auth::checkLogged() && GameModel::isGameMaster(Session::get('user_id'), Request::post('game_id'))){
            $event_date = date("Ymd",  strtotime(Request::post('event_date')));
            $event_start = ScheduleModel::convertTimeText(Request::post('event_start'));
            $event_end = ScheduleModel::convertTimeText(Request::post('event_end'));
            ScheduleModel::addGameScheduleEvent(Request::post('game_id'), $event_date,
                        $event_start, $event_end, utf8_decode(html2text(Request::post('event_description')))
                    );
            Redirect::back(Request::post('redirect'));
        } else{
            Redirect::home();
        }
    }
    
    public function deleteGameEvent(){
        if(Auth::checkLogged() && ScheduleModel::getGameEventOwner(Request::post('event_id')) == Session::get('user_id')){
            ScheduleModel::deleteGameScheduleEvent(Request::post('event_id'));
            echo Request::post('event_id');
        } else{
            echo 'memo';
        }
    }
}