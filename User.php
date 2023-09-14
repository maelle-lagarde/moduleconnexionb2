<?php
class User {
    private $id;
    private $firstname;
    private $lastname;
    private $login;
    private $password;
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];
    
            $stmt = $this->db->prepare("SELECT * FROM user WHERE login = :login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $hashedPassword = $row['password'];
                
    
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['login'] = $row['login'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['password'] = $row['password'];
    
                    if ($_SESSION['login'] === 'admiN1337$') {
                        echo '<script>
                            alert("Connexion en tant que administrateur réussie ! Vous allez être redirigé vers la page administration.");
                            window.location.href = "admin.php";
                        </script>';
                    } else {
                        echo'<script>
                            alert("Connexion réussie ! Vous allez être redirigé vers votre profil.");
                            window.location.href = "profil.php";
                        </script>';
                    }
                    exit;
                } else {
                    echo "<script>alert('Mot de passe incorecte');</script>";
                }
            } else {
                echo "<script>alert('Login incorecte');</script>";
            }
        }
    }    

    public function updateProfile($login, $firstname, $lastname, $password) {
        // mettre à jour les informations du profil dans la base de données.
        $stmt = $this->db->prepare("UPDATE user SET login = ?, firstname = ?, lastname = ?, password = ? WHERE id = ?");
        $stmt->execute([$login, $firstname, $lastname, $password, $this->id]);
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

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}
?>