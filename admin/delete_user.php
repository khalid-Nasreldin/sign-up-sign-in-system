<?php
if(isset($_GET["id"])){
    $mysqli = require __DIR__ . "/connection.php";
    $sql = "DELETE FROM users WHERE id={$_GET["id"]}";
    $result = $mysqli->query($sql);
    header("Location: dashboard.php");
    exit;
}