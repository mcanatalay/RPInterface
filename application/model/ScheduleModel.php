<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class ScheduleModel{
    
    public static function getGameSchedule($game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM game_schedule WHERE game_id = :game_id";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id));
        $schedule = array();
        
        foreach($query->fetchAll() as $event){
            $schedule[$event->event_day] = new stdClass();
            $schedule[$event->event_day] = $event;
        }
        
        return $schedule;
    }
    
    public static function getWeeklyGameSchedule($game_id, $week_start, $week_end){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM game_schedule WHERE game_id = :game_id AND event_date >= :week_start AND event_date < :week_end ORDER BY event_date,event_start,event_creation_timestamp ASC";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':week_start' => $week_start, ':week_end' => $week_end));
        $schedule = array();
        
        foreach($query->fetchAll() as $event){
            if(!isset($schedule[$event->event_date])){
                $schedule[$event->event_date] = array();
            }
            $schedule[$event->event_date][$event->event_id] = new stdClass();
            $schedule[$event->event_date][$event->event_id] = $event;            
        }
        
        return $schedule;
    }
    
    public static function addGameScheduleEvent($game_id, $event_date, $event_start, $event_end, $event_description){
        $event_creation_timestamp = time();
        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO game_schedule(game_id, event_date, event_start, event_end, event_description, event_creation_timestamp)
                    VALUES(:game_id, :event_date, :event_start, :event_end, :event_description, :event_creation_timestamp)";
        $query = $database->prepare($sql);
        $query->execute(array(':game_id' => $game_id, ':event_date' => $event_date,
                                ':event_start' => $event_start, 'event_end' => $event_end, ':event_description' => $event_description,
                                    ':event_creation_timestamp' => $event_creation_timestamp));
        
        if($query->rowCount() == 1){
            FeedModel::pushNotification(GameModel::getGameMaster($game_id), $game_id, 2, "NEW_EVENT");
            return true;
        }
        
        return false;
    }
    
    public static function deleteGameScheduleEvent($event_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM game_schedule WHERE event_id = :event_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array('event_id' => $event_id));
        
        if($query->rowCount() == 1){
            return true;
        }
        
        return false;
    }
    
    public static function deleteAllGameScheduleEvents($game_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM game_schedule WHERE game_id = :game_id";
        $query = $database->prepare($sql);
        $query->execute(array('game_id' => $game_id));
        
        return true;
    }
    
    public static function getGameEventOwner($event_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM game_schedule WHERE event_id = :event_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));
        $game_id = $query->fetch()->game_id;

        if($query->rowCount() == 1){
            return GameModel::getGameMaster($game_id);
        }
        
        //ADD FEEDBACK HERE
        return null;
    }
    
    
    public static function getTimeText($time){
        if($time%2 == 0){
            $hour = ($time/2).':00';
        } else{
            $hour = (($time-1)/2).':30';
        }
        
        if(strlen($hour) == 4){
            $hour = '0' . $hour; 
        }
        
        return $hour;
    }
    
    public static function convertTimeText($text){
        if(strlen($text) != 5){
            return 0;
        }
        
        $hour = (int) substr($text,0,2);
        $minute = (int) substr($text,3,2);

        if($minute >= 30){
            return 2*$hour+1;
        }
        
        return 2*$hour;
    }
    
    
    
    
}