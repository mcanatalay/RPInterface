<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class TextModel{
    private $texts;
    private $bb_parser;
    
    public function get($key){
        // if not $key
        if (!$key){
            return null;
        }
        // load config file (this is only done once per application lifecycle)
        if (!$this->texts){
            //TODO use session to enable user to select language
            $language = strtolower(trim(strip_tags(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))));
            $language_file = Config::get('PATH_LANGUAGE').$language.'.php';
            if(!file_exists($language_file)){
                $language_file = Config::get('PATH_LANGUAGE').Config::get('DEFAULT_LANGUAGE').'.php';
            }
            $this->texts = require($language_file);
        }
        // check if array key exists
        if (!array_key_exists($key, $this->texts)) {
                return null;
        }
        return $this->texts[$key];
    }
    
    public function getFullLanguage(){
        $lang = $this->getLanguage();
        if($lang == "tr"){
            return "tr_TR.UTF8";
        } else{
            return "en_US.UTF8";
        }
    }


    public function getLanguage(){
        return strtolower(trim(strip_tags(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))));
    }
    
    public function time_elapsed_string($ptime){
        $etime = time() - $ptime;

        if ($etime < 1){
            return '0'.$this->get('TIME_SECONDS');
        }
        $a = array( 365 * 24 * 60 * 60  =>  'year',
                     30 * 24 * 60 * 60  =>  'month',
                          24 * 60 * 60  =>  'day',
                               60 * 60  =>  'hour',
                                    60  =>  'minute',
                                     1  =>  'second'
                    );
        $a_plural = array( 'year'   => $this->get('TIME_YEARS'),
                           'month'  => $this->get('TIME_MONTHS'),
                           'day'    => $this->get('TIME_DAYS'),
                           'hour'   => $this->get('TIME_HOURS'),
                           'minute' => $this->get('TIME_MINUTES'),
                           'second' => $this->get('TIME_SECONDS')
                    );
        foreach ($a as $secs => $str){
            $d = $etime / $secs;
            if ($d >= 1){
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' '.$this->get('TIME_AGO');
            }
        }
    }
    
    public function bb_parse($text){
        if(!$text){
            return null;
        }
        
        if ($this->bb_parser){
            $this->bb_parser = new JBBCode\Parser();
            $this->bb_parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
            $builder = new JBBCode\CodeDefinitionBuilder('center', '<p style="text-align: center;">{param}</p>');
            $this->bb_parser->addCodeDefinition($builder->build());
            
            $builder2 = new JBBCode\CodeDefinitionBuilder('video', '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" allowfullscreen="" src="//www.youtube.com/embed/{param}?rel=0"></iframe></div>');
            $this->bb_parser->addCodeDefinition($builder2->build());
            
            $builder3 = new JBBCode\CodeDefinitionBuilder('size', '<font size="{option}">{param}</font>');
            $builder3->setUseOption(true);
            $this->bb_parser->addCodeDefinition($builder3->build());
            
            $builder4 = new JBBCode\CodeDefinitionBuilder('font', '<font face="{option}">{param}</font>');
            $builder4->setUseOption(true);
            $this->bb_parser->addCodeDefinition($builder4->build());
            
            $builder5 = new JBBCode\CodeDefinitionBuilder('bullist', '<ul>{param}</ul>');
            $this->bb_parser->addCodeDefinition($builder5->build());
            
            $builder6 = new JBBCode\CodeDefinitionBuilder('numlist', '<ol>{param}</ol>');
            $this->bb_parser->addCodeDefinition($builder6->build());
            
            $builder7 = new JBBCode\CodeDefinitionBuilder('*', '<li>{param}</li>');            
            $this->bb_parser->addCodeDefinition($builder7->build());
        }
        
        $this->bb_parser->parse(utf8_decode(html2text($text)));
        return nl2br($this->bb_parser->getAsHtml());
    }
}