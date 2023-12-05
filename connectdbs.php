<?php


$servername = "smcse-stuproj00.city.ac.uk";
$username = "adbs915";
$password = "200016376";
$database = "adbs915";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
         printf("Connection failed: %s\n", $connection->connect_error);
         exit();
      } else {
        echo "Database connected successfully!";
      }
 ?> 
