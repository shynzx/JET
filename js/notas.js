document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("noteModal");
    const modalContent = document.querySelector(".modal_body");
    const noteCards = document.querySelectorAll(".note_card");
    const createNoteModal = document.getElementById("create_noteModal");
    const newNoteButton = document.querySelector(".create_note");
    const createNoteForm = document.getElementById("create_noteForm");

    noteCards.forEach(card => {
        card.addEventListener("click", function (event) {
            event.stopPropagation();  // Evita que se cierre inmediatamente después de abrir
            const noteDetail = this.querySelector(".note_detail").innerHTML;
            modalContent.innerHTML = noteDetail;
            modal.style.display = "block";
            document.body.classList.add("modal-open");  // Añade la clase para deshabilitar el scroll
        });
    });

    window.addEventListener("click", function (event) {
        if (event.target == modal || event.target == createNoteModal) {
            modal.style.display = "none";
            createNoteModal.style.display = "none";
            document.body.classList.remove("modal-open");  // Quita la clase para habilitar el scroll
        }
    });

    newNoteButton.addEventListener("click", function (event) {
        event.stopPropagation();
        createNoteModal.style.display = "block";
        document.body.classList.add("modal-open");  // Añade la clase para deshabilitar el scroll
    });

    createNoteForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const title = document.getElementById("new_note_title").value;
        const tags = document.getElementById("new_note_tags").value.split(',').map(tag => tag.trim());
        const content = document.getElementById("new_note_content").value;
        const date = new Date().toLocaleDateString();

        const newNoteCard = document.createElement("div");
        newNoteCard.classList.add("note_card");
        newNoteCard.innerHTML = `
            <div class="note_summary">
                <h3 class="note_title">${title}</h3>
                <p class="note_date">Fecha de creación: ${date}</p>
                <p class="note_tags">Etiquetas: ${tags.join(', ')}</p>
            </div>
            <div class="note_detail">
                <p>${content}</p>
            </div>
        `;

        document.querySelector(".note_list-container").appendChild(newNoteCard);
        
        // Añadir evento para que la nueva nota abra el modal
        newNoteCard.addEventListener("click", function (event) {
            event.stopPropagation();
            const noteDetail = this.querySelector(".note_detail").innerHTML;
            modalContent.innerHTML = noteDetail;
            modal.style.display = "block";
            document.body.classList.add("modal-open");
        });

        createNoteModal.style.display = "none";
        document.body.classList.remove("modal-open");  // Quita la clase para habilitar el scroll
        createNoteForm.reset();
    });

    
});
