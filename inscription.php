<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="box">
       <h1>Inscription</h1>
        <form action="process-inscription.php" method="post">
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
