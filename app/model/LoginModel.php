<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../controllers/LoginController.php";

    $email = isset($_POST["correo"]) ? $_POST["correo"] : '';
    $password = isset($_POST["contraseña"]) ? $_POST["contraseña"] : '';

    $loginController = new LoginController();
    $loggedIn = $loginController->login($email, $password);

    if ($loggedIn) {
        $_SESSION['autenticado'] = true;
        // Redirigir al usuario a la página principal o al área de usuario
        header("Location: ../views/tarea.php");
        exit;
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>
