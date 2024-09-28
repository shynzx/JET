<?php
require_once '../controllers/TaskController.php';

header('Content-Type: application/json');

if (!isset($_GET['task_id'])) {
    echo json_encode(['error' => 'No se proporcionó el ID de la tarea.']);
    exit();
}

$taskId = $_GET['task_id'];
$taskController = new TaskController();

$task = $taskController->getTaskById($taskId);

if ($task) {
    echo json_encode($task);
} else {
    echo json_encode(['error' => 'No se pudo obtener la tarea.']);
}
?>
