<?php

class cambiar_contraseña{

public function change_pass($email,$password_hashed){
    require_once "../../config/conection.php";
    $databaseConn = DataBase::getInstance();

    try {
        $query = "CALL update_password(:email, :user_password)";
        $stmt = $databaseConn::$databaseConnection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':user_password', $password_hashed);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
}
?>
