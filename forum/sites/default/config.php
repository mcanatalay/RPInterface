<?php

/* 
 * @CODOLICENSE
 */

defined('IN_CODOF') or die();

$installed=true;

function get_codo_db_conf() {


    $config = array (
  'driver' => 'mysql',
  'host' => 'localhost',
  'database' => 'rpinterf_forum',
  'username' => 'rpinterf_public',
  'password' => 'ElFrn3c*RtJm',
  'prefix' => '',
  'charset' => 'utf8',
  'collation' => 'utf8_unicode_ci',
);

    return $config;
}

$DB = get_codo_db_conf();

$CONF = array (
    
  'driver' => 'Custom',
  'UID'    => '55f80ee723f46',
  'SECRET' => '55f80ee723fa7',
  'PREFIX' => ''
);
