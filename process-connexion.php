<?php

require_once 'User.php';

ob_start();

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    
    if ($user->login($_POST['login'], $_POST['password'])) {
        $_SESSION['user'] = $user;

        if ($user->login === 'admiN1337$') { 
            header('Location: admin.php');
        } else {
            var_dump('coucou toi');
            header('Location: profil.php');
        }
        
    } else {
        echo "Échec de la connexion. Vérifiez vos informations.";
    }
}

ob_end_flush();

?>