<?php

require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $user->register($_POST['firstname'], $_POST['lastname'], $_POST['login'], $_POST['password']);

    echo '<script>
              alert("Inscription réussie ! Vous allez être redirigé vers la page de connexion.");
              window.location.href = "connexion.php";
          </script>';
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="favicon.png" type="image/x-icon"/>
</head>
<body>

    <div class="nav">
        <div class="nav-left"><a href="index.php">Accueil</a></div>
        <div class="nav-right"><a href="logout.php">Déconnexion</a></div>
    </div>

    <div class="box">
       <h1>Inscription</h1>
        <form action="inscription.php" method="post">
            <input type="text" name="firstname" placeholder="Prénom" required><br>
            <input type="text" name="lastname" placeholder="Nom" required><br>
            <input type="text" name="login" placeholder="Login" required><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required><br>
            <input id="button" type="submit" value="Inscription">
    </form> 
    </div>
</body>
</html>