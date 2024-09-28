<?php 
session_start();
include('../../config/conection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="../../style/style_recuperacion.css" />
    <link rel="shortcut icon" href="../../favicon_io/favicon.ico" type="image/x-icon">
</head>

<body>

    <div class="container">
        <form id="recoverForm" method="post" action="../model/UploadImageModel.php">
            <div class="logo">
                <h1>Just Enough Time</h1>
            </div>
            <h2>Subir Imagen</h2>
            <div id="step3">
                <div class="input-box">
                    <input type="file" placeholder="imagen" name = "imagen" id="imagen" enctype="multipart/form-data" required>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Subir imagen</button>
            </div>
        </form>
    </div>

</body>

</html>