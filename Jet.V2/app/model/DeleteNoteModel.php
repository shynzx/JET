<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['id_user'])) {
        echo json_encode(['success' => false, 'error' => 'No estás autorizado para realizar esta acción.']);
        exit();
    }

    $idNote = $_POST['id_note'];
    $idUser = $_SESSION['id_user'];

    require_once '../controllers/NoteController.php';

    $NoteController = new NoteController();
    $result = $NoteController->deleteNote($idNote, $idUser);

    if ($result) {
        echo json_encode(['success' => false, 'error' => 'Failed to delete note.']);

    } else {
        echo json_encode(['success' => true]);

    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>

