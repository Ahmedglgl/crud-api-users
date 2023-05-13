<?php 

// Get the IP address of the API container
$api_host = gethostbyname('persons_api');

// Construct the URL using the IP address and port number
$api_url = "http://{$api_host}:8080/persons";

echo $api_url;