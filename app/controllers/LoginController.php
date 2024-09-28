<?php
class LoginController {
    public function login($email, $password) {
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try {
            // Verificar si el usuario existe
            $query = "SELECT id_user, username, user_password FROM users WHERE email = :email";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result && password_verify($password, $result['user_password'])) {
                // Inicio de sesión exitoso
                session_start();
                $_SESSION['id_user'] = $result['id_user'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['email'] = $email;

                return true;
            } else {
                // Credenciales incorrectas
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
