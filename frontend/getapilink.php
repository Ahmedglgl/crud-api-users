<?php 

$host = $_SERVER['SERVER_NAME'];
$port = 8080;
$apiUrl = "http://{$host}:{$port}/persons/";
echo $apiUrl;