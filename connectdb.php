<?php

$servername = "smcse-stuproj00.city.ac.uk";
$username = "adbs915";
$pasword = "200016736";
$database = "adbs915";

$connection = new mysqli($servername, $usernsmr, $password, $database);

if ($connection->connect_error) {
		 printf("Connection failed: %s\n", $connection->connect_error);
		 exit();
	 } 
 ?> 

<
