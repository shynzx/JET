document.addEventListener("DOMContentLoaded", function () {
    const createNoteModal = document.getElementById("create_noteModal");
    const newNoteButton = document.querySelector(".create_note");
    const createNoteForm = document.getElementById("create_noteForm");

    newNoteButton.addEventListener("click", function(event){
        event.stopPropagation();
        createNoteModal.style.display = "block";
        document.body.classList.add("modal-open");
    });

    // Función para cerrar el modal al hacer clic fuera de él
    window.onclick = function(event) {
        if (event.target == createNoteModal) {
            createNoteModal.style.display = "none";
            document.body.classList.remove("modal-open");
        }
    };    
});
