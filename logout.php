<?php

// déconnecter la session actuelle.
session_start();

session_destroy();

// rediriger vers la page "index.php".
header('Location: index.php');
exit;

?>