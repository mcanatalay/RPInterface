<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class LineModel{

    public static function getLine($master_type, $master_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM `lines` WHERE master_type = :master_type AND master_id = :master_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':master_type' => $master_type, ':master_id' => $master_id));
        $line = $query->fetch();

        if($query->rowCount() == 1){
            return $line;
        }
        
        //ADD FEEDBACK HERE
        return null;
    }
    
    public static function getLineID($master_type, $master_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT line_id FROM `lines` WHERE master_type = :master_type AND master_id = :master_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':master_type' => $master_type, ':master_id' => $master_id));
        $line = $query->fetch();

        if($query->rowCount() == 1){
            return $line->line_id;
        }
        
        //ADD FEEDBACK HERE
        return null;
    }
    
    public static function getLineOwner($line_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM `lines` WHERE line_id = :line_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':line_id' => $line_id));
        $line = $query->fetch();

        if($query->rowCount() == 1){
            return $line->user_id;
        }
        
        //ADD FEEDBACK HERE
        return null;
    }
    
    public static function getAllEntriesByLineID($line_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM line_entries WHERE line_id = :line_id
                            ORDER BY entry_creation_timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute(array(':line_id' => $line_id));
        
        $entries = array();
        
        foreach($query->fetchAll() as $entry){
            $entries[$entry->entry_id] = new stdClass();
            $entries[$entry->entry_id]->entry_id = $entry->entry_id;
            $entries[$entry->entry_id]->line_id = $entry->line_id;
            $entries[$entry->entry_id]->entry_title = $entry->entry_title;
            $entries[$entry->entry_id]->entry_text_source = $entry->entry_text_source;
            $entries[$entry->entry_id]->entry_text = $entry->entry_text;
            $entries[$entry->entry_id]->entry_position = $entry->entry_position;
            $entries[$entry->entry_id]->entry_ico = $entry->entry_ico;
            $entries[$entry->entry_id]->entry_color = $entry->entry_color;
            $entries[$entry->entry_id]->entry_creation_timestamp = $entry->entry_creation_timestamp;
            $entries[$entry->entry_id]->entry_modified_timestamp = $entry->entry_modified_timestamp;
        }
        
        return $entries;
    }
    
    public static function getEntryOwner($entry_id){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT line_id FROM line_entries WHERE entry_id = :entry_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':entry_id' => $entry_id));
        $line = $query->fetch();

        if($query->rowCount() == 1){
            $line_id = $line->line_id;
        } else{
            return null;
        }
        
        //ADD FEEDBACK HERE
        return self::getLineOwner($line_id);
    }
    
    public static function newLine($master_type, $master_id, $user_id){
        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO `lines`(master_type, master_id, user_id) VALUES(:master_type, :master_id, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':master_type' => $master_type, ':master_id' => $master_id, 
                                    ':user_id' => $user_id));
        
        if($query->rowCount()){
            FeedModel::pushNotification($user_id, $master_id, $master_type, "NEW_LINE");
            return true;
        }
        //Add Feedback for line error create
        return false;
    }
        
    public static function newEntry($line_id, $entry_title, $entry_text_source, $entry_position, $entry_ico, $entry_color){
        $entry_text = Text::bb_parse($entry_text_source);
        $entry_creation_timestamp = time();

        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO line_entries(line_id, entry_title,
                    entry_text_source, entry_text, entry_position, entry_ico, entry_color, entry_creation_timestamp)
                        VALUES(:line_id, :entry_title, :entry_text_source, :entry_text, :entry_position,
                            :entry_ico, :entry_color, :entry_creation_timestamp)";
        $query = $database->prepare($sql);
        $query->execute(array(':line_id' => $line_id, ':entry_title' => $entry_title, 
            ':entry_text_source' => nl2br($entry_text_source), ':entry_text' => $entry_text,
                ':entry_position' => $entry_position, 'entry_ico' => $entry_ico, 'entry_color' => $entry_color,
                    ':entry_creation_timestamp' => $entry_creation_timestamp));
                
        if($query->rowCount()){
            //Add Feedback for entry successfuly add
            return true;
        }
        //Add Feedback for entry error add
        return false;
    }
        
    public static function deleteEntry($entry_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM line_entries WHERE entry_id = :entry_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':entry_id' => $entry_id));
        
        $count = $query->rowCount();
        
        if($count == 1){
            //Add Feedback for post successfuly deleted
            return true;
        }
        //Add Feedback for post error deleted
        return false;
    }
    
    public static function deleteAllEntriesByLineID($line_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM line_entries WHERE line_id = :line_id";
        $query = $database->prepare($sql);
        $query->execute(array(':line_id' => $line_id));
                
        if($query->rowCount()){
            //Add Feedback
            return true;
        }
        //Add Feedback
        return false;
    }
    
    public static function deleteLine($line_id){
        $database = Database::getFactory()->getConnection();
        $sql = "DELETE FROM `lines` WHERE line_id = :line_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':line_id' => $line_id));
        
        if($query->rowCount()){
            return self::deleteAllEntriesByLineID($line_id);
        }
        
        //Add Feedback
        return false;
    }
       
}
