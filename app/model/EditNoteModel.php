<?php
// Configuración para no mostrar errores en la respuesta
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');

header('Content-Type: application/json');

try {
    if (!isset($_POST['note_id'])) {
        throw new Exception('note_id no definido');
    }

    $note_id = $_POST['note_id'];
    $title = $_POST['title'];
    $tags = $_POST['tags'];
    $content = $_POST['content'];

    
    // Aquí iría la lógica para actualizar la nota en la base de datos

    echo json_encode(array("success" => true));
} catch (Exception $e) {
    // Registrar el error en el log de errores
    error_log($e->getMessage());

    // Enviar una respuesta JSON con el error
    echo json_encode(array("success" => false, "message" => $e->getMessage()));
}

