<?php
require_once '../controllers/NoteController.php';

header('Content-Type: application/json');

if (!isset($_GET['note_id'])) {
    echo json_encode(['error' => 'No se proporcionó el ID de la nota.']);
    exit();
}

$noteId = $_GET['note_id'];
$noteController = new NoteController();

$note = $noteController->getNoteById($noteId);

if ($note) {
    echo json_encode($note);
} else {
    echo json_encode(['error' => 'No se pudo obtener la tarea.']);
}
?>