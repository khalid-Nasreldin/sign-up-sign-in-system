<?php
$is_valid_login = true;
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = require __DIR__ . "/connection.php";
    $sql = sprintf("SELECT * FROM users WHERE email='%s'", $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    
    if($user){
        if(password_verify($_POST["password"], $user["password_hash"])){
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;
        }else{
            $is_valid_login = false;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <form method="post">
            <input type="email" name="email" value="<?php if(!$is_valid_login) echo $_POST["email"] ?>" placeholder="E-Mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <?php if(!$is_valid_login): ?>
                <em style="color: white;">ivalid login, check the email or the password</em>
            <?php endif ?>
            <button type="submit" name="login">login</button>
            <p style="color: white; margin-top: 15px;">Don't Have an Account? <a href="signup.html">signup</a></p>
        </form>
    </div>
</body>
</html>