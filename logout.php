<?php

// déconnecter la session actuelle.
session_start();

session_destroy();

// rediriger vers la page "index.php".
echo '<script>
              alert("Vous avez été correctement déconnecté, merci pour votre visite et à bientôt :)");
              window.location.href = "index.php";
          </script>';

?>