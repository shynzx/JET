<?php
require_once '../controllers/TaskController.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['id_user'])) {
    echo json_encode(['error' => 'No estás autorizado para realizar esta acción.']);
    exit();
}

$userId = $_SESSION['id_user'];
$taskController = new TaskController();
$userTasks = $taskController->getUserTasks($userId);

echo json_encode($userTasks);
?>


