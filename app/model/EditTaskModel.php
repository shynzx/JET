<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['id_user'])) {
        // Si no está iniciada la sesión, devolver un mensaje de error
        echo json_encode(['success' => false, 'message' => 'No estás autorizado para realizar esta acción.']);
        exit();
    }

    // Obtener los datos del formulario
    $idTask = $_POST['id_task'];
    $taskTitle = $_POST['title'];
    $tags = $_POST['tags']; // Etiquetas como una cadena separada por comas
    $content = $_POST['content'];
    $finishDate = $_POST['finish_date'];
    $idUser = $_SESSION['id_user'];

    require_once '../controllers/TaskController.php';
    $TaskController = new TaskController();
    
    $result = $TaskController->editTask($idTask, $idUser, $taskTitle, $content, $finishDate, $tags);
    


    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update task.']);
    }
}
?>
