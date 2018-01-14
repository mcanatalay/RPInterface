<?php

$sourceURI = Config::get('URL');
$targetURI = Config::get('URL');
$service = 'http://blogsearch.google.com/ping/RPC2';

$request = xmlrpc_encode_request("pingback.ping", array($sourceURI, $targetURI));
$context = stream_context_create(array('http' => array(
    'method' => "POST",
    'header' => "Content-Type: text/xml",
    'content' => $request
)));

$file = file_get_contents($service, false, $context);
$response = xmlrpc_decode($file);

if ($response && xmlrpc_is_fault($response)){
    trigger_error("xmlrpc: $response[faultString] ($response[faultCode])");
} else{
    print_r($response);
}