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
    $tags = $_POST['tags']; 
    $content = $_POST['content'];


    require_once '../controllers/NoteController.php';
    $userId = $_SESSION['id_user'];
    
    $NoteController = new NoteController();
    $result = $NoteController->createNote($userId, $title, $tags, $content);
    
    if ($result){
        header("Location:../views/notas.html");
        exit;
    } else{
        echo "Failed register";
    }
}
?>