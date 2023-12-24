<?php

if(empty($_POST["first_name"])){
    die("First name is required");
}
if(empty($_POST["last_name"])){
    die("Last name is required");
}
if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Valid E-Mail is required");
}
if(strlen($_POST["password"]) < 6){
    die("Password must at least 6");
}
if(!preg_match("/[a-z]/", $_POST["password"])){
    die("Password must contain letters");
}
if(!preg_match("/[0-9]/", $_POST["password"])){
    die("Password must contain numbers");
}
if($_POST["password"] !== $_POST["password_confirmation"]){
    die("Password must match");
}
if(empty($_POST["gender"])){
    die("Gender is required");
}
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/connection.php";
$sql = "INSERT INTO users(first_name, last_name, email, password_hash, gender) VALUES(?,?,?,?,?)";
$stmt = $mysqli->stmt_init();
if(!$stmt->prepare($sql)){
    die("SQL error : " . $mysqli->error);
}
$stmt->bind_param("sssss", $first_name, $last_name, $email, $password_hash, $gender);
if($stmt->execute()){
    header("Location: login.php");
    exit;
}