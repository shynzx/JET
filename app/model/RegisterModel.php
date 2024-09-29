<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "../controllers/RegisterController.php";

    $userName = $_POST["usuario"];
    $password = $_POST["contraseña"];
    $email = $_POST["correo"];
    $password_hashed = password_hash($password,PASSWORD_BCRYPT);

    $registerController = new RegisterController();
    $newUser = $registerController -> register($userName,$email,$password_hashed);

    if ($newUser){
        header("Location:../views/login.html");
        exit;
    } else{
        echo "Failed register";
    }
}
?>