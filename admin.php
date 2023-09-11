<?php

session_start();

require_once 'User.php';

if (!isset($_SESSION['user']) || $_SESSION['user']->getLogin() !== 'admin') {
    header('Location: connexion.php');
    exit();
}

$users = User::getAllUsers();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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