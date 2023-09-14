<?php

require_once 'User.php';

session_start();

if (isset($_POST['login']) && isset($_POST['password'])) {
    $user = new User();
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($user->login($login, $password)) {
        $_SESSION['user'] = $user;

        if ($_SESSION['user']['login'] === 'admiN1337$')  {
            echo '<script>
                     alert("Connexion en tant qu\'administrateur réussie ! Vous allez être redirigé vers la page administration.");
                     window.location.href = "admin.php";
                  </script>';
        } else {
            echo '<script>
                     alert("Connexion réussie ! Vous allez être redirigé vers votre profil.");
                     window.location.href = "profil.php";
                  </script>';
        }
    } else {
        echo '<script>
                 alert("Échec de la connexion. Vérifiez vos informations.");
                 window.location.href = "connexion.php"; // Redirige vers la page de connexion
              </script>';
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
            <input id="button" type="submit" value="Connexion" name="login-process">
        </form>
    </div>
</body>
</html>
