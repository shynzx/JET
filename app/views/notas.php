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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/notas.css">


    <title>J.E.T</title>
</head>

<body>
    <header class="header">
        <div class="logo">
            <a id="logo" href="index.php">
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
            <div class="notes_header">
                <h2>Notas</h2>
                <div class="notes_actions">
                    <button class="create_note">
                        <ion-icon class="new_icon" name="add-circle-outline"></ion-icon>
                        Nuevo
                    </button>
                    <div class="notes_filters">
                        <label for="filter-tag">Etiqueta:</label>
                        <select id="filter-tag">
                            <option value="">Todas</option>
                            <option value="etiqueta1">Etiqueta 1</option>
                            <option value="etiqueta2">Etiqueta 2</option>
                            <option value="etiqueta3">Etiqueta 3</option>
                        </select>

                        <label for="sort">Ordenar por:</label>
                        <select id="sort">
                            <option value="alphabetical">Alfabético</option>
                            <option value="date">Fecha de creación</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="notes_list">
                <div class="note_list-container">
                    <div class="note_card">
                        <div class="note_summary">
                            <h3 class="note_title"></h3>
                            <p class="note_date"></p>
                            <p class="note_tags"></p>
                        </div>
                        <div class="note_options">
                            <ion-icon name="pencil-outline" onclick="openEditModal()"></ion-icon>
                        </div>
                        <div class="note_detail">
                            <p>
                                
                            </p>
                        </div>
                    </div>

                    <div id="noteModal" class="modal">
                        <div class="modal_content">
                            <div class="modal_body"></div>
                        </div>
                    </div>
                </div>

                <div id="create_noteModal" class="modal">
                    <div class="modal_content">
                        <div class="modal_body">
                            <h2>Crear Nueva Nota</h2>
                            <form id="create_noteForm">
                                <label for="new_note_title">Título:</label>
                                <input type="text" id="new_note_title" name="title" required>

                                <label for="new_note_tags">Etiquetas:</label>
                                <input type="text" id="new_note_tags" name="tags" placeholder="Separar con comas">

                                <label for="new_note_content">Contenido:</label>
                                <textarea id="new_note_content" name="content" rows="4" required></textarea>

                                <button type="submit">Guardar Nota</button>
                            </form>
                        </div>
                    </div>
                </div>


                <div id="editNoteModal" class="modal">
                    <div class="modal_content">
                        <div class="modal_body">
                            <h2>Editar Nota</h2>
                            <form id="edit_noteForm">
                                <label for="edit_note_title">Título:</label>
                                <input type="text" id="edit_note_title" name="title" required>

                                <label for="edit_note_tags">Etiquetas:</label>
                                <input type="text" id="edit_note_tags" name="tags" placeholder="Separar con comas">

                                <label for="edit_note_content">Contenido:</label>
                                <textarea id="edit_note_content" name="content" rows="4" required></textarea>

                                <button type="submit">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>


        </section>
    </main>

    <div class="footer_esqueleto">
    </div>


    <script src="../../js/notas.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>