<?php
  //Cargar sesion del usuario logueado
  session_start();
	if(!isset($_SESSION['autenticado'])){//Si no hay un usuario logueado, regresar al logueo**
    header("Location: index.php");

  }
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../../style/style_config.css" />
		<link rel="stylesheet" href="../../style/notas.css">
        <link rel="shortcut icon" href="/favicon_io/favicon.ico" type="image/x-icon">
		<title>Configuración de Usuario</title>
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
	

		<main class="configuracion_usuario">
			<h1>Configuración de Usuario</h1>
			<div class="container">
				<div class="profile">
					<img
						src="../../img/a80e3690318c08114011145fdcfa3ddb.jpg"
						alt="Profile Picture"
					/>
					<span>
						Nombre: <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Invitado'; ?>
					</span>
				</div>
				<div class="menu-item">
					<a href="cambiar_contraseña.html" class="cambiar_contraseña">Cambiar contraseña</a>
				</div>
				<div class="menu-item">
					<a href="#">Vincular a Google</a>
				</div>
				<div class="menu-item">

					<a id="CloseSesion" href="../controllers/CloseSesion.php">Cerrar Sesión</a>
				</div>
			</div>
			<div class="regreso">
				<a href="javascript:history.back()">Regresar</a>
			</div>
		</main>

		<footer>
			<div class="footer_container">
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
		</footer>


		<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
		<script src="js/recuperación.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	</body>
</html>
