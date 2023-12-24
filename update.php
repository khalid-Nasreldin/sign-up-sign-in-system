<?php
session_start();
if(isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/connection.php";
    $sql = "SELECT * FROM users WHERE id={$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $new_password = $_POST["password"];
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $gender = $_POST["gender"];
        if($new_password !== $_POST["password_confirmation"]){
            die("Password Must Match");
        }
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', password_hash='$new_password_hash', gender='$gender' WHERE id={$_SESSION["user_id"]}";
        $result = $mysqli->query($sql);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <form method="post">
            <input type="text" name="first_name" value="<?php echo ($user["first_name"]) ?>" required>
            <input type="text" name="last_name" value="<?php echo ($user["last_name"]) ?>" required>
            <input type="email" name="email" value="<?php echo ($user["email"]) ?>" required>
            <input type="password" name="password" placeholder="New Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <select name="gender" required>
                <option value="" selected disabled>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <button type="submit" name="update">update</button>
        </form>
    </div>
</body>
</html>