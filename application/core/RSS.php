<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class RSS{
    public static function get($feed_url){
        $file = file_get_contents($feed_url);
        $xml = new SimpleXMLElement($file);
        $content = array();
        foreach($xml->channel->item as $element){
            $date = strtotime($element->pubDate);
            $children = $element->children('http://purl.org/dc/elements/1.1/');
            $content[$date] = new stdClass();
            $content[$date]->date = $date;
            $content[$date]->site_name = (string) $xml->channel->title;
            $content[$date]->site_img_link = SiteModel::getFavico($element->link);
            $content[$date]->title = (string) $element->title;
            $content[$date]->link = (string) $element->link;
            $content[$date]->description = (string) $element->description;
            $content[$date]->creator = (string) $children->creator;
            $content[$date]->category = array();
            foreach($element->category as $category){
                $content[$date]->category[] = (string) $category;
            }
        }
        
        return $content;
    }
    
    public static function getMultiple($feed_urls){
        $contents = array();
        foreach($feed_urls as $feed_url){
            $contents = array_replace($contents,self::get($feed_url));
        }
        krsort($contents);
        return $contents;
    }
    
    public static function getLimited($feed_url, $limit = 1){
        $file = file_get_contents($feed_url);
        $xml = new SimpleXMLElement($file);
        $content = array();
        $i = 0;
        foreach($xml->channel->item as $element){
            if($limit == $i){
                break;
            }
            $i++;
            $date = strtotime($element->pubDate);
            $children = $element->children('http://purl.org/dc/elements/1.1/');
            $content[$date] = new stdClass();
            $content[$date]->date = $date;
            $content[$date]->title = (string) $element->title;
            $content[$date]->link = (string) $element->link;
            $content[$date]->description = (string) $element->description;
            $content[$date]->creator = (string) $children->creator;
            $content[$date]->category = array();
            foreach($element->category as $category){
                $content[$date]->category[] = (string) $category;
            }
        }
        
        return $content;
    }
    
    public static function getMultipleLimited($feed_urls,$limit=1){
        $contents = self::getMultiple($feed_urls);
        krsort($contents);
        
        return array_slice($contents,0,$limit);
    }
}
