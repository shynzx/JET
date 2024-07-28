<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['id_user'])) {
        echo json_encode(['success' => false, 'error' => 'No estás autorizado para realizar esta acción.']);
        exit();
    }

    $idTask = $_POST['id_task'];
    $idUser = $_SESSION['id_user'];

    require_once '../controllers/TaskController.php';

    $TaskController = new TaskController();
    $result = $TaskController->deleteTask($idTask, $idUser);

    if ($result) {
        echo json_encode(['success' => false, 'error' => 'Failed to delete task.']);

    } else {
        echo json_encode(['success' => true]);

    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>

