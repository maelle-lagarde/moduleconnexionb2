<?php

session_start();

require_once 'User.php';

if (!isset($_SESSION['user'])) {
    
    echo '<script>
              alert("Inscrivez-vous ou connectez-vous pour accéder au site.");
              window.location.href = "index.php";
          </script>';

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
    <link rel="icon" href="favicon.png" type="image/x-icon"/>
</head>
<body>

    <div class="nav">
        <div class="nav-left"><a href="index.php">Accueil</a></div>
        <div class="nav-right"><a href="logout.php">Déconnexion</a></div>
    </div>

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