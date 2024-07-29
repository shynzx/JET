<?php
  //Cargar sesion del usuario logueado
  session_start();
	if(!isset($_SESSION['autenticado'])){//Si no hay un usuario logueado, regresar al logueo**
    header("Location: index.php");

  }
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../../style/sytle_calendario.css" />
		<link rel="shortcut icon" href="/favicon_io/favicon.ico" type="image/x-icon">
		<title>J.E.T</title>
	</head>


<body>
	<header class="header">
        <div class="logo">
            <a id="logo" href="tarea.php">
                <img src="../../img/marca.png" alt="Logo de la app.">
            </a>
        </div>
        <div class="header_content">
            <nav>
                <a href="tarea.php">
                    <ion-icon name="list-outline" class="nav_icon"></ion-icon> Tareas
                </a>
                <a href="notas.php">
                    <ion-icon name="document-outline" class="nav_icon"></ion-icon> Notas
                </a>
                <a href="calendario.php">
                    <ion-icon name="calendar-number-outline" class="nav_icon"></ion-icon> Calendario
                </a>
            </nav>
            <div class="header_iconos">
                <a href="#">
                    <ion-icon name="notifications-outline" class="icon not_icon"></ion-icon>
                </a>
                <a href="cofig_usuario.php">
                    <ion-icon name="person-circle-outline" class="icon user_icon"></ion-icon>
                </a>
            </div>
        </div>
	</header>



	<main>
		<section class="notes">
                <div class="conectar">
                    <p>Se requiere conectar con una cuenta de Google para usar la funcion de calendario <br>
                    da click al boton de vincular para iniciar con Google</p>
                    <button>Vincular</button>
                </div>

	</main>

		<footer>
			<div class="footer_container" id="footer">
				<div>
					<a href="aviso_privacidad.html"> Aviso de privacidad </a>
				</div>
				<div>
					<a href="terminos_condiciones.html"> Terminos y condiciones </a>
				</div>
				<div>
					<a href="mapa.html"> Mapa del sitio </a>
				</div>
			</div>
			<div class="derechos">
				Todos los derechos reservados por Santana Saste Roger, Herrera Loeza
				Enrique y Uc Pool Francisco &copy;
			</div>
		</div>
		<script src="script/sidebar.js"></script>
		<script src="script/notas.js"></script>
		<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	</body>
</html>
