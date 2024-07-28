<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $verificationCode = $data['verificationCode'];

    // Aquí debes agregar la lógica para verificar el código
    // Por ejemplo, comparar el código con el almacenado en la base de datos

    // Ejemplo básico de respuesta
    echo json_encode(["success" => true, "message" => "Código verificado correctamente"]);
} else {
    header("HTTP/1.1 403 Forbidden");
}
?>
