<?php

require_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $user->register($_POST['firstname'], $_POST['lastname'], $_POST['login'], $_POST['password']);
    header('Location: connexion.php');
}
?>