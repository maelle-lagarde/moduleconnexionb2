<?php
class User {
    private $id;
    private $firstname;
    private $lastname;
    private $login;
    private $password;
    private $role;
    private $db;

    public function __construct() {
        // initialisation de la connexion à la base de données.
        $dbHost = 'localhost';
        $dbName = 'moduleconnexionb2';
        $dbUser = 'root';
        $dbPass = 'root';

        try {
            $this->db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function register($firstname, $lastname, $login, $password) {
        // valider les données.
        if (!$this->isValidPassword($password)) {
            return false;
        }

        // vérifier si le login est déjà utilisé.
        if ($this->isLoginTaken($login)) {
            return false;
        }

        // hasher le mot de passe.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // insérer les données dans la base de données.
        $stmt = $this->db->prepare("INSERT INTO user (firstname, lastname, login, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $login, $hashedPassword]);
        return true;
    }

    public function login($login, $password) {
        // récupérer l'utilisateur par son login.
        $stmt = $this->db->prepare("SELECT * FROM user WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // les informations de connexion sont correctes.
   
            $this->id = $user['id'];
            $this->firstname = $user['firstname'];
            $this->lastname = $user['lastname'];
            $this->login = $user['login'];
            $this->password = $user['password'];

            return true;
        } else {
            return false;
        }
    }

    public function updateProfile($firstname, $lastname) {
        // mettre à jour les informations du profil dans la base de données.
        $stmt = $this->db->prepare("UPDATE user SET firstname = ?, lastname = ? WHERE id = ?");
        $stmt->execute([$firstname, $lastname, $this->id]);
    }

    public static function getAllUsers() {
        // récupérer tous les utilisateurs de la base de données.
        $dbHost = 'localhost';
        $dbName = 'moduleconnexionb2';
        $dbUser = 'root';
        $dbPass = 'root';

        try {
            $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->query("SELECT * FROM user");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    private function isValidPassword($password) {
        // valider que le mot de passe a au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.
        return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }

    private function isLoginTaken($login) {
        // vérifier si le login est déjà utilisé.
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM user WHERE login = ?");
        $stmt->execute([$login]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function getLogin() {
        return $this->login;
    }

    public function isAdmin() {
        // préparez la requête SQL pour récupérer l'utilisateur par son rôle.
        $stmt = $this->db->prepare("SELECT * FROM user WHERE role = 'admin'");
        $stmt->execute();
        
        // récupérez le résultat de la requête.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // vérifiez si un utilisateur avec le rôle 'admin' a été trouvé.
        if ($user) {
            return true;
        }
        return false;
    }

}
?>