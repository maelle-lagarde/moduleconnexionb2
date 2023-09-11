<?php

session_start();

require_once 'User.php';

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->updateProfile($_POST['firstname'], $_POST['lastname']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="box">
        <h1>Profil</h1>
        <form action="" method="post">
            <input type="text" name="firstname" placeholder="Prénom" value="<?php echo $user->getFirstname(); ?>" required><br>
            <input type="text" name="lastname" placeholder="Nom" value="<?php echo $user->getLastname(); ?>" required><br>
            <input id="button" type="submit" value="Mettre à jour">
        </form>
    </div>
</body>
</html>
