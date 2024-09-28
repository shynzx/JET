<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $newPassword = $data['newPassword'];

    // Aquí debes agregar la lógica para cambiar la contraseña
    // Por ejemplo, actualizar la contraseña en la base de datos

    // Ejemplo básico de respuesta
    echo json_encode(["success" => true, "message" => "Contraseña cambiada exitosamente"]);
} else {
    header("HTTP/1.1 403 Forbidden");
}
?>
