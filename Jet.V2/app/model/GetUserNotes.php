<?php
require_once '../controllers/NoteController.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['id_user'])) {
    echo json_encode(['error' => 'No estás autorizado para realizar esta acción.']);
    exit();
}

$userId = $_SESSION['id_user'];
$noteController = new NoteController();
$userNotes = $noteController->getUserNotes($userId);

echo json_encode($userNotes);
?>