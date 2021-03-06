<?php

require_once realpath(dirname(__FILE__).'/../../') . '/autoload.php';

class Request{
    /**
     * Gets/returns the value of a specific key of the POST super-global.
     * When using just Request::post('x') it will return the raw and untouched $_POST['x'], when using it like
     * Request::post('x', true) then it will return a trimmed and stripped $_POST['x'] !
     *
     * @param mixed $key key
     * @param bool $clean marker for optional cleaning of the var
     * @return mixed the key's value or nothing
     */
    public static function post($key, $clean = false){
        if (isset($_POST[$key])) {
            // we use the Ternary Operator here which saves the if/else block
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            return ($clean) ? trim(strip_tags($_POST[$key])) : $_POST[$key];
        }
    }
    
    /**
     * Returns the state of a checkbox.
     *
     * @param mixed $key key
     * @return mixed state of the checkbox
     */
    public static function postCheckbox($key){
        return isset($_POST[$key]) ? 1 : NULL;
    }
    
    /**
     * gets/returns the value of a specific key of the GET super-global
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function get($key){
        if (isset($_GET[$key])){
            return $_GET[$key];
        }
    }
    
    /**
     * gets/returns the value of a specific key of the COOKIE super-global
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function cookie($key){
        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }
    }
    
    /**
     * gets/returns the value of a specific key of the SERVER super-global
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function server($key){
        if (isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }
    }
    
    /**
     * gets/returns the value of a specific key of the FILES super-global
     * @param mixed $key key
     * @return mixed the key's value or nothing
     */
    public static function files($key){
        if (isset($_FILES[$key])) {
            return $_FILES[$key];
        }
    }
}