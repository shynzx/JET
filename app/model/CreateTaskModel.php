<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['id_user'])) {
        // Si no está iniciada, devolver un mensaje de error o redirigir al usuario
        echo "No estás autorizado para realizar esta acción.";
        exit(); // Terminar el script si la sesión no está iniciada
    }

    // Obtener los datos del formulario
    $title = $_POST['title'];
    $tags = $_POST['tags']; // Etiquetas como una cadena separada por comas
    $content = $_POST['content'];
    $finishDate = $_POST['finish_date'];


    require_once '../controllers/TaskController.php';
    $userId = $_SESSION['id_user'];
    
    $TaskController = new TaskController();
    $result = $TaskController->createTask($userId, $title, $tags, $content, $finishDate);
    
    if ($result){
        header("Location:../views/tarea.php");
        exit;
    } else{
        echo "Failed register";
    }
}
?>


