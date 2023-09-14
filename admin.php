<?php

session_start();

require_once 'User.php';

$users = User::getAllUsers();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="favicon.png" type="image/x-icon"/>
</head>
<body>

    <div class="nav">
        <div class="nav-left"><a href="index.php">Accueil</a></div>
        <div class="nav-right"><a href="logout.php">Déconnexion</a></div>
    </div>

    <div class="box">
        <h1>Administration</h1>
        <table>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Login</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['firstname']; ?></td>
                    <td><?php echo $user['lastname']; ?></td>
                    <td><?php echo $user['login']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>