<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class SiteModel{
    public static function getAllNews($limit){
        $database = Database::getFactory()->getConnection();
        $sql = "SELECT * FROM website WHERE site_status = :site_status";
        $query = $database->prepare($sql);
        $query->execute(array(':site_status' => 1));
        
        if($query->rowCount() > 0){
            $feed_urls = array();
            foreach($query->fetchAll() as $site){
                $feed_urls[] = $site->rss_link;
            }
            return RSS::getMultipleLimited($feed_urls, $limit);
        }
        
        return null;
    }
    
    public static function getFavico($url){
        return "http://www.google.com/s2/favicons?domain=".$url;
    }
}