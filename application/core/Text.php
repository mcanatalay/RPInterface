<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class Text{
    private static $texts;
    private static $bb_parser;
    
    public static function get($key){
        // if not $key
        if (!$key){
            return null;
        }
        // load config file (this is only done once per application lifecycle)
        if (!self::$texts){
            //TODO use session to enable user to select language
            $language = strtolower(trim(strip_tags(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))));
            $language_file = Config::get('PATH_LANGUAGE').$language.'.php';
            if(!file_exists($language_file)){
                $language_file = Config::get('PATH_LANGUAGE').Config::get('DEFAULT_LANGUAGE').'.php';
            }
            self::$texts = require($language_file);
        }
        // check if array key exists
        if (!array_key_exists($key, self::$texts)) {
                return null;
        }
        return self::$texts[$key];
    }
    
    public static function getFullLanguage(){
        $lang = self::getLanguage();
        if($lang == "tr"){
            return "tr_TR";
        } else{
            return "en_US";
        }
    }


    public static function getLanguage($setting){
        return strtolower(trim(strip_tags(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))));
    }
    
    public static function time_elapsed_string($ptime){
        $etime = time() - $ptime;

        if ($etime < 1){
            return '0'.self::get('TIME_SECONDS');
        }
        $a = array( 365 * 24 * 60 * 60  =>  'year',
                     30 * 24 * 60 * 60  =>  'month',
                          24 * 60 * 60  =>  'day',
                               60 * 60  =>  'hour',
                                    60  =>  'minute',
                                     1  =>  'second'
                    );
        $a_plural = array( 'year'   => self::get('TIME_YEARS'),
                           'month'  => self::get('TIME_MONTHS'),
                           'day'    => self::get('TIME_DAYS'),
                           'hour'   => self::get('TIME_HOURS'),
                           'minute' => self::get('TIME_MINUTES'),
                           'second' => self::get('TIME_SECONDS')
                    );
        foreach ($a as $secs => $str){
            $d = $etime / $secs;
            if ($d >= 1){
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' '.self::get('TIME_AGO');
            }
        }
    }
    
    public static function bb_parse($text){
        if(!$text){
            return null;
        }
        
        if (!self::$bb_parser){
            $bb_parser = new JBBCode\Parser();
            $bb_parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
            $builder = new JBBCode\CodeDefinitionBuilder('center', '<p style="text-align: center;">{param}</p>');
            $bb_parser->addCodeDefinition($builder->build());

            $builder1 = new JBBCode\CodeDefinitionBuilder('justify', '<p style="text-align: justify;">{param}</p>');
            $bb_parser->addCodeDefinition($builder1->build());
            
            $builder2 = new JBBCode\CodeDefinitionBuilder('video', '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" allowfullscreen="" src="//www.youtube.com/embed/{param}?rel=0"></iframe></div>');
            $bb_parser->addCodeDefinition($builder2->build());
            
            $builder3 = new JBBCode\CodeDefinitionBuilder('size', '<font size="{option}">{param}</font>');
            $builder3->setUseOption(true);
            $bb_parser->addCodeDefinition($builder3->build());
            
            $builder4 = new JBBCode\CodeDefinitionBuilder('font', '<font face="{option}">{param}</font>');
            $builder4->setUseOption(true);
            $bb_parser->addCodeDefinition($builder4->build());
            
            $builder5 = new JBBCode\CodeDefinitionBuilder('bullist', '<ul>{param}</ul>');
            $bb_parser->addCodeDefinition($builder5->build());
            
            $builder6 = new JBBCode\CodeDefinitionBuilder('numlist', '<ol>{param}</ol>');
            $bb_parser->addCodeDefinition($builder6->build());
            
            $builder7 = new JBBCode\CodeDefinitionBuilder('*', '<li>{param}</li>');            
            $bb_parser->addCodeDefinition($builder7->build());
        }
        
        $bb_parser->parse(nl2br($text));
        return $bb_parser->getAsHtml();
    }
    
    public static function makeParagraphs($val) {
        $out = nl2br($val);
        $out = '<p>' . preg_replace('#(?:<br\s*/?>\s*?){2,}#', '</p><p>', $out) . '</p>';
        
        $out = preg_replace('#<p>(\s*<br\s*/?>)+#', '</p><p>', $out);
        $out = preg_replace('#<br\s*/?>(\s*</p>)+#', '<p></p>', $out);
        $out = str_replace("</p></p>", "</p><p></p>", $out);
        $out = str_replace("<p></p>", "<p>&nbsp;</p>", $out);
        
        return $out;
    }
}