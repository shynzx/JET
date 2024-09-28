<?php
require_once '../controllers/TaskController.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['id_user'])) {
    echo json_encode(['error' => 'No estás autorizado para realizar esta acción.']);
    exit();
}

if (!isset($_POST['task_id'])) {
    echo json_encode(['error' => 'No se proporcionó el ID de la tarea.']);
    exit();
}

$taskId = $_POST['task_id'];
$taskController = new TaskController();

$result = $taskController->updateTaskStatus($taskId, 'completada');

if ($result) {
    echo json_encode(['success' => 'El estado de la tarea se actualizó correctamente.']);
} else {
    echo json_encode(['error' => 'No se pudo actualizar el estado de la tarea.']);
}
?>

