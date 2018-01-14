<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

/*
 * Use it like this:
 * $database = Database::getFactory()->getConnection();
 */

class Database{
    
    private static $factory;
    private $database;
    
    public static function getFactory(){
        if (!self::$factory){
            self::$factory = new Database();
        }
        return self::$factory;
    }
    
    public function getConnection(){
        if (!$this->database) {
            $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
            $this->database = new PDO(
                Config::get('DB_TYPE') . ':host=' . Config::get('DB_HOST') . ';dbname=' .
                Config::get('DB_NAME') . ';port=' . Config::get('DB_PORT') . ';charset=' . Config::get('DB_CHARSET'),
                Config::get('DB_USER'), Config::get('DB_PASS'), $options
            );
        }
        return $this->database;
    }
}