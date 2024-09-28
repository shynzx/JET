<?php
class RegisterController{
    public function register($userName,$email,$password_hashed){
        require_once "../../config/conection.php";
        $databaseConn = DataBase::getInstance();

        try {
            $query = "CALL InsertUser(:username, :email, :user_password)";
            $stmt = $databaseConn::$databaseConnection->prepare($query);
            $stmt->bindParam(':username', $userName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':user_password', $password_hashed);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == '45000') {
                echo "El correo electrónico ya está en uso.";
            } else {
                echo "Error: " . $e->getMessage();
            }
            return false;
        }
    }
}
?>