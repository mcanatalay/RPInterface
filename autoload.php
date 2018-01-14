<?php

include_once realpath(dirname(__FILE__)) . '/components/Others/password_compatibility_library.php';
include_once realpath(dirname(__FILE__)) . '/components/Others/html2text.php';

spl_autoload_register(function ($classname) {
    $filedir = realpath(dirname(__FILE__)) . '/' . findPath($classname) .".php";
    if(file_exists($filedir)){
        include_once($filedir);
    }
});

function checkClassType($classname,$classtype){
    if (strpos($classname,$classtype) !== false){
        return true;
    }
    return false;
}

function findPath($classname){
    if($classname == "Config" || $classname == "Database"
            || $classname == "Controller" || $classname == "Redirect"
            || $classname == "Request" || $classname == "Session"
            || $classname == "Text" || $classname == "View"
            || $classname == "Application" || $classname == "Auth"
            || $classname == "Filter" || $classname == "Mail"
            || $classname == "Social" || $classname == "RSS"
            ||$classname == "Functions"){
        return 'application/core/'.$classname;
        
    } elseif(checkClassType($classname, "Controller")){
        return 'application/controller/'.$classname;
        
    } elseif(checkClassType($classname, "Model")){
        return 'application/model/'.$classname; 
        
    } elseif($classname == "PHPMailer"){
        return 'components/PHPMailer/'.$classname;
    } elseif($classname == "codoforum_sso"){
        return 'components/Others/'.$classname;
    } else{
        return 'components/'. str_replace('\\', '/',$classname);
    }
}