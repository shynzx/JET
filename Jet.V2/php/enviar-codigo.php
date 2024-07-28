<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];

    // Aquí debes agregar la lógica para enviar el código de verificación al email
    // Por ejemplo, generar un código, guardarlo en la base de datos y enviar el email

    // Ejemplo básico de respuesta
    echo json_encode(["success" => true, "message" => "Código de verificación enviado"]);
} else {
    header("HTTP/1.1 403 Forbidden");
}
?>
