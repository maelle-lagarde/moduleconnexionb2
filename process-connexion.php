<?php
session_start();
require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    if ($user->login($_POST['login'], $_POST['password'])) {
        $_SESSION['user'] = $user;
        header('Location: profil.php');
    } else {
        echo "Échec de la connexion. Vérifiez vos informations.";
    }
}
?>
