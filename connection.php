<?php

$host = "localhost";
$username = "root";
$password = "";
$db_name = "main_db";

$mysqli = new mysqli(hostname:$host, username:$username, password:$password, database:$db_name);

if($mysqli->connect_error){
    die("Connection error" . $mysqli->connect_error);
}

return $mysqli;