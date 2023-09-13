<?php

require_once 'User.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    
    if ($user->login($_POST['login'], $_POST['password'])) {
        $_SESSION['user'] = $user;

        if ($user->isAdmin()) { 
            echo'<script>
                    alert("Connexion en tant que administrateur réussie ! Vous allez être redirigé vers la page administration.");
                    window.location.href = "admin.php";
                </script>';
        } else {
            echo'<script>
                    alert("Connexion réussie ! Vous allez être redirigé vers votre profil.");
                    window.location.href = "profil.php";
                </script>';
        }
        
    } else {
        echo "Échec de la connexion. Vérifiez vos informations.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="favicon.png" type="image/x-icon"/>
</head>
<body>

    <div class="nav">
        <div class="nav-left"><a href="index.php">Accueil</a></div>
        <div class="nav-right"><a href="logout.php">Déconnexion</a></div>
    </div>

    <div class="box">
        <h1>Connexion</h1>
        <form action="connexion.php" method="post">
            <input type="text" name="login" placeholder="Login" required><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <input id="button" type="submit" value="Connexion">
        </form>
    </div>
</body>
</html>
