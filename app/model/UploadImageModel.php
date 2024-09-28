<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['id_user'])) {
        // Si no está iniciada la sesión, devolver un mensaje de error
        echo json_encode(['success' => false, 'message' => 'No estás autorizado para realizar esta acción.']);
        header('location:../views/index.html');
        exit();
    }

    // Obtener datos del formulario.
    $imagen = $_FILES['imagen']['name'];
    $tmp = $_FILES['imagen']['tmp_name'];
    // Obtener ID de usuario.
    $id_user = $_SESSION['id_user'];

    require_once '../controllers/UploadImageController.php';

    $UploadImage = new UploadImage();
    $result = $UploadImage->upload_image($id_user, $imagen);
    
    if ($result){
        move_uploaded_file($tmp,'../../img'.$tmp);
        header("Location:../views/cofig_user");
        exit;
    } else{
        echo "Failed upload";
    }


}


?>