<?php

require_once 'User.php';

// ob_start();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    
    if ($user->login($_POST['login'], $_POST['password'])) {
        $_SESSION['user'] = $user;
        // var_dump('coucou you');

        if ($user->login === 'admiN1337$') { 
            header('Location: admin.php');
            exit();
        } else {
            var_dump('coucou toi');
            header('Location: profil.php');
            exit();
        }
        
    } else {
        echo "Échec de la connexion. Vérifiez vos informations.";
    }
}

// ob_end_flush();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
