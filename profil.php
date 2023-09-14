<?php

session_start();

require_once 'User.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['new-password'])) {
        $newLogin = $_POST['login'];
        $newFirstname = $_POST['firstname'];
        $newLastname = $_POST['lastname'];
        $currentPassword = $_POST['password'];
        $newPassword = $_POST['new-password'];

        // Vérifiez si le mot de passe actuel est correct
        if ($user->login($user->getLogin(), $currentPassword)) {
            // Le mot de passe actuel est correct, mettez à jour les informations de l'utilisateur
            $user->updateProfile($newLogin, $newFirstname, $newLastname, $newPassword);

            // Mise à jour des informations de session
            $_SESSION['login'] = $newLogin;
            $_SESSION['firstname'] = $newFirstname;
            $_SESSION['lastname'] = $newLastname;

            // Redirigez l'utilisateur vers la page d'accueil.
            echo '<script>
                     alert("Informations correctement mises à jour.");
                     window.location.href = "index.php";
                  </script>';
        } else {
            $error = "Informations incorrectes.";
        }
    } else {
        $error = "Veuillez remplir tous les champs du formulaire.";
    }
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
            <input type="text" name="firstname" placeholder="Prénom" value="<?php echo $_SESSION['firstname']; ?>" required><br>
            <input type="text" name="lastname" placeholder="Nom" value="<?php echo $_SESSION['lastname']; ?>" required><br>
            <input type="text" name="login" placeholder="Login" value="<?php echo $_SESSION['login']; ?>" required><br>
            <input type="password" name="password" placeholder="Mot de passe actuel" required><br>
            <input type="password" name="new-password" placeholder="Nouveau mot de passe" required><br>
            <input id="button" type="submit" value="Mettre à jour">
        </form>
    </div>
</body>
</html>