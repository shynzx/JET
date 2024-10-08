<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style_tarea.css">
    <title>J.E.T</title>

    
</head>

<body>
    <header class="header">
        <div class="logo">
            <a id="logo" href="../views/index.html">
                <img src="../../img/marca.png" alt="Logo de la app.">
            </a>
        </div>
        <div class="header_content">
            <nav>
                <a href="#">
                    <ion-icon name="list-outline" class="nav_icon"></ion-icon> Tareas
                </a>
                <a href="   notas.html">
                    <ion-icon name="document-outline" class="nav_icon"></ion-icon> Notas
                </a>
                <a href="../calendario.html">
                    <ion-icon name="calendar-number-outline" class="nav_icon"></ion-icon> Calendario
                </a>
            </nav>
            <div class="header_iconos">
                <a href="#">
                    <ion-icon name="notifications-outline" class="icon not_icon"></ion-icon>
                </a>
                <a class="usuario" href="cofig_usuario.php">
                    <ion-icon name="person-circle-outline" class="icon user_icon"></ion-icon>
                </a>
            </div>
        </div>
    </header>


    <main>
        <section class="tasks">
            <div class="tasks_header">
                <h2>Tarea</h2>
                <div class="tasks_actions">
                    <button class="create_task">
                        <ion-icon class="new_icon" name="add-circle-outline"></ion-icon>
                        Nuevo
                    </button>
                    <div class="tasks_filters">
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

            <div class="task_lists-container">
                <div class="task-container">
                    <h3>TAREAS PENDIENTES</h3>
                    <div class="task_list" id="pending_tasks">
                        
                    </div>
                </div>
                <div class="task-container">
                    <h3>TAREAS COMPLETADAS</h3>
                    <div class="task_list_completed" id="completed_tasks">
                        
                    </div>
                </div>
            </div>

            <div id="taskModal" class="modal">
                <div class="modal_content">
                    <div class="modal_body"></div>
                    <button id="complete_task" class="btn_completar">COMPLETADA</button>
                </div>
            </div>

            <div id="create_taskModal" class="modal">
                <div class="modal_content">
                    <div class="modal_body">
                        <h2>Crear Nueva Tarea</h2>
                        <form id="create_taskForm" action="../model/CreateTaskModel.php" method="post">
                            <label for="new_task_title">Título:</label>
                            <input type="text" id="new_task_title" name="title" required>
        
                            <label for="new_task_tags">Etiquetas:</label>
                            <input type="text" id="new_task_tags" name="tags" placeholder="Separar con comas">
        
                            <label for="new_task_content">Contenido:</label>
                            <textarea id="new_task_content" name="content" rows="4" required></textarea>

                            <label for="new_task_date">Fecha de entrega:</label>
                            <input type="date" id="new_task_date" name="finish_date" placeholder=" Usar formato A-M-D H:M:S">

                            <button id="crear_tarea" type="submit">Crear Tarea</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="edit_taskModal" class="modal">
                <div class="modal_content">
                    <div class="modal_body">
                        <h2 id="editModalTitle">Editar Tarea</h2>
                        <form id="edit_taskForm" action="../model/EditTaskModel.php" method="post">
                            <label for="edit_task_title">Título:</label>
                            <input type="text" id="edit_task_title" name="title" required>
            
                            <label for="edit_task_tags">Etiquetas:</label>
                            <input type="text" id="edit_task_tags" name="tags" placeholder="Separar con comas">
            
                            <label for="edit_task_content">Contenido:</label>
                            <textarea id="edit_task_content" name="content" rows="4" required></textarea>
        
                            <label for="edit_task_date">Fecha de entrega:</label>
                            <input type="text" id="edit_task_date" name="finish_date" placeholder=" Usar formato A-M-D H:M:S">
        
                            <button id="guardar_tarea" type="submit" >Guardar Cambios</button>
                            <button id="eliminar_tarea" type="button">Eliminar Tarea</button>
                        </form>
                    </div>
                </div>

        </section>
    </main>



    <div class="footer_esqueleto">
        <footer class="footer">
            <div class="footer_container">
                <div>
                    <a target="_blank" href="#">
                        Aviso de privacidad
                    </a>
                </div>
                <div>
                    <a target="_blank" href="#">
                        TÃ©rminos y condiciones
                    </a>
                </div>
                <div>
                    <a target="_blank" href="#">
                        Mapa del sitio
                    </a>
                </div>
            </div>
            <div class="derechos">
                Todos los derechos reservados por Santana Saste Roger, Herrera Loeza Enrique y Uc Pool Francisco &copy;
            </div>
        </footer>
    </div>

    <script src="../../js/tarea.js"></script>
    <script src="../../js/tareasModal.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>