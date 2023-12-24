<?php
$mysqli = require __DIR__ . "/connection.php";
$sql = "SELECT * FROM users";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin">
        <h1>dashboard</h1>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>e-mail</th>
                    <th>gender</th>
                    <th>join date</th>
                    <th>action</th>
                </tr>
                <tbody>
                    <?php while($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo($user["id"]) ?></td>
                            <td><?php echo($user["first_name"]) ?></td>
                            <td><?php echo($user["last_name"]) ?></td>
                            <td><?php echo($user["email"]) ?></td>
                            <td><?php echo($user["gender"]) ?></td>
                            <td><?php echo($user["join_data"]) ?></td>
                            <td><a href="delete_user.php?id=<?php echo $user["id"] ?>">delete</a></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </thead>
        </table>
    </div>
</body>
</html>