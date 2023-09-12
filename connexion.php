<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="nav">
        <div class="nav-left"><a href="index.php">Accueil</a></div>
        <div class="nav-right"><a href="#logout">Déconnexion</a></div>
    </div>

    <div class="box">
        <h1>Connexion</h1>
        <form action="process-connexion.php" method="post">
            <input type="text" name="login" placeholder="Login" required><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <input id="button" type="submit" value="Connexion">
        </form>
    </div>
</body>
</html>
