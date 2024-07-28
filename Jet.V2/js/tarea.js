document.addEventListener("DOMContentLoaded", function () {
    let currentTaskId = null;

    const createTaskModal = document.getElementById("create_taskModal");
    const newTaskButton = document.querySelector(".create_task");
    const createTaskForm = document.getElementById("create_taskForm");
    const editTaskModal = document.getElementById("edit_taskModal");
    const editTaskForm = document.getElementById("edit_taskForm");
    const modal = document.getElementById("taskModal");
    const modalContent = document.querySelector("#taskModal .modal_body");
    const completeTaskButton = document.getElementById("complete_task");
    const modalTitle = document.getElementById("modalTitle");
    const editModalTitle = document.getElementById("editModalTitle");
    const deleteTaskButton = document.getElementById("eliminar_tarea");

    newTaskButton.addEventListener("click", function (event) {
        event.stopPropagation();
        createTaskForm.reset();
        currentTaskId = null;
        modalTitle.textContent = "Crear Nueva Tarea";
        createTaskModal.style.display = "block";
        document.body.classList.add("modal-open");
    });

    window.addEventListener("click", function (event) {
        if (event.target === createTaskModal) {
            createTaskModal.style.display = "none";
            document.body.classList.remove("modal-open");
        }
        if (event.target === editTaskModal) {
            editTaskModal.style.display = "none";
            document.body.classList.remove("modal-open");
        }
        if (event.target === modal) {
            modal.style.display = "none";
            document.body.classList.remove("modal-open");
        }
    });

    function addTaskEventListeners(taskCard) {
        taskCard.addEventListener("click", function (event) {
            event.stopPropagation();
            const taskDetail = this.querySelector(".task_detail").innerHTML;
            modalContent.innerHTML = taskDetail;
            modal.style.display = "block";
            document.body.classList.add("modal-open");
            currentTaskId = this.dataset.taskId;
        });

        const editButton = taskCard.querySelector("button#edit_task"); // Cambiado a 'button#edit_task'
        editButton.addEventListener("click", function (event) {
            event.stopPropagation();
            const taskId = taskCard.dataset.taskId;
            fetch(`../model/GetTaskById.php?task_id=${taskId}`)
                .then(response => response.json())
                .then(task => {
                    document.getElementById("edit_task_title").value = task.task_title;
                    document.getElementById("edit_task_tags").value = task.tags;
                    document.getElementById("edit_task_content").value = task.task_body;
                    document.getElementById("edit_task_date").value = task.finish_date;
                    currentTaskId = taskId;
                    editModalTitle.textContent = "Editar Tarea";
                    editTaskModal.style.display = "block";
                    document.body.classList.add("modal-open");
                })
                .catch(error => console.error('Error fetching task:', error));
        });
    }

    editTaskForm.addEventListener("submit", function (event) {
        event.preventDefault();
    
        const taskTitle = document.getElementById("edit_task_title").value;
        const tags = document.getElementById("edit_task_tags").value;
        const content = document.getElementById("edit_task_content").value;
        const finishDate = document.getElementById("edit_task_date").value;
    
        const formData = new FormData();
        formData.append("id_task", currentTaskId);
        formData.append("title", taskTitle);
        formData.append("tags", tags);
        formData.append("content", content);
        formData.append("finish_date", finishDate);
    
        fetch('../model/EditTaskModel.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(text => {
            console.log('Respuesta del servidor:', text); // Verifica la respuesta completa
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    alert('Tarea actualizada con éxito');
                    editTaskModal.style.display = "none";
                    document.body.classList.remove("modal-open");
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            } catch (e) {
                console.error('Error al analizar la respuesta JSON:', e);
                alert('Error inesperado: ' + text);
            }
        })
        .catch(error => console.error('Error al actualizar la tarea:', error));
        
    });
    

    deleteTaskButton.addEventListener("click", function () {
        if (currentTaskId) {
            fetch('../model/DeleteTaskModel.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id_task=${currentTaskId}`
            })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => { throw new Error(text); });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Tarea eliminada con éxito');
                        editTaskModal.style.display = "none";
                        document.body.classList.remove("modal-open");
                        document.querySelector(`.task_card[data-task-id='${currentTaskId}']`).remove();
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => console.error('Error al eliminar la tarea:', error));
        } else {
            console.error('No hay tarea seleccionada para eliminar.');
        }
    });

    completeTaskButton.addEventListener("click", function () {
        if (currentTaskId) {
            fetch('../model/UpdateTaskStatus.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `task_id=${currentTaskId}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Tarea completada con éxito');
                        modal.style.display = "none";
                        document.body.classList.remove("modal-open");
                        location.reload();
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => console.error('Error al completar la tarea:', error));
        } else {
            console.error('No hay tarea seleccionada para completar.');
        }
    });

    fetch('../model/GetUserTask.php')
        .then(response => response.json())
        .then(data => {
            console.log("Datos de tareas recibidos:", data);
            if (data.error) {
                alert(data.error);
            } else {
                renderTasks(data);
            }
        })
        .catch(error => console.error('Error fetching tasks:', error));

    function renderTasks(tasks) {
        const pendingTasksContainer = document.getElementById('pending_tasks');
        const completedTasksContainer = document.getElementById('completed_tasks');

        pendingTasksContainer.innerHTML = '';
        completedTasksContainer.innerHTML = '';

        tasks.forEach(task => {
            const taskCard = document.createElement('div');
            taskCard.classList.add('task_card');
            taskCard.dataset.taskId = task.id_task;

            taskCard.innerHTML = `
                <div class="task_summary">
                    <h4 class="task_title">${task.task_title}</h4>
                    <p class="task_date">Fecha de entrega: ${task.finish_date}</p>
                    <p class="task_tags">Etiquetas: ${task.tags}</p>
                </div>
                <div class="task_options">
                    <button id="edit_task">
                        <ion-icon name="pencil-outline"></ion-icon>
                    </button>
                </div>
                <div class="task_detail">
                    <p>${task.task_body}</p>
                </div>
            `;

            if (task.task_status === 'pendiente') {
                pendingTasksContainer.appendChild(taskCard);
            } else {
                completedTasksContainer.appendChild(taskCard);
            }

            addTaskEventListeners(taskCard);
        });
    }
});
