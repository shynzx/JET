<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "../controllers/UpdatePasswordController.php";

    $password = $_POST["contraseña"];
    $email = $_POST["correo"];
    $password_hashed = password_hash($password,PASSWORD_BCRYPT);

    $registerController = new Cambiar_contraseña();
    $newUser = $registerController -> change_pass($email,$password_hashed);

    if ($newUser){
        header("Location:../views/login.html");
        exit;
    } else{
        echo "Failed update";
    }
}

?>