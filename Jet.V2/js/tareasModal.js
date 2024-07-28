document.addEventListener("DOMContentLoaded", function () {
    const createTaskModal = document.getElementById("create_taskModal");
    const newTaskButton = document.querySelector(".create_task");
    const createTaskForm = document.getElementById("create_taskForm");
    

    newTaskButton.addEventListener("click", function(event){
        event.stopPropagation();
        createTaskModal.style.display = "block";
        document.body.classList.add("modal-open");
    });

    // Función para cerrar el modal al hacer clic fuera de él
    window.onclick = function(event) {
        if (event.target == createTaskModal) {
            createTaskModal.style.display = "none";
            document.body.classList.remove("modal-open");
        }
    };    

    
});
