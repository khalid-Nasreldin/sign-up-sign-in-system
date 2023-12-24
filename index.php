<?php
session_start();
if(isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/connection.php";
    $sql = "SELECT * FROM users WHERE id={$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="box">
            <?php if(isset($user)): ?>
                <h1>welcome <?php echo$user["first_name"] . "  " . $user["last_name"] ?></h1>
                <p><a href="update.php">update account</a> or <a href="logout.php">logout</a></p>
            <?php else: ?>
                <h1>welcome to family</h1>
                <p><a href="signup.html">signup</a> or <a href="login.php">login</a></p>
            <?php endif?>
        </div>
    </div>
</body>
</html>