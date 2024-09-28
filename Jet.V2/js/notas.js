document.addEventListener("DOMContentLoaded", function () {
    let currentNoteId = null;

    const createNoteModal = document.getElementById("create_noteModal");
    const newNoteButton = document.querySelector(".create_note");
    const createNoteForm = document.getElementById("create_noteForm");
    const editNoteModal = document.getElementById("editNoteModal");
    const editNoteForm = document.getElementById("edit_noteForm");
    const noteModal = document.getElementById("noteModal");
    const noteModalContent = document.querySelector("#noteModal .modal_body");
    const deleteNoteButton = document.getElementById("eliminar_nota");

    console.log(createNoteModal, newNoteButton, createNoteForm, editNoteModal, editNoteForm, noteModal, noteModalContent, deleteNoteButton);

    newNoteButton.addEventListener("click", function (event) {
        event.stopPropagation();
        createNoteForm.reset();
        currentNoteId = null;
        createNoteModal.style.display = "block";
        document.body.classList.add("modal-open");
    });

    window.addEventListener("click", function (event) {
        if (event.target === createNoteModal) {
            createNoteModal.style.display = "none";
            document.body.classList.remove("modal-open");
        }
        if (event.target === editNoteModal) {
            editNoteModal.style.display = "none";
            document.body.classList.remove("modal-open");
        }
        if (event.target === noteModal) {
            noteModal.style.display = "none";
            document.body.classList.remove("modal-open");
        }
    });

    function addNoteEventListeners(noteCard) {
        noteCard.addEventListener("click", function (event) {
            event.stopPropagation();
            const noteDetail = this.querySelector(".note_detail").innerHTML;
            noteModalContent.innerHTML = noteDetail;
            noteModal.style.display = "block";
            document.body.classList.add("modal-open");
            currentNoteId = this.dataset.noteId;
        });

        const editButton = noteCard.querySelector("button#edit_note");
        editButton.addEventListener("click", function (event) {
            event.stopPropagation();
            const noteId = noteCard.dataset.noteId;
            fetch(`../model/GetNoteById.php?note_id=${noteId}`)
                .then(response => response.json())
                .then(note => {
                    document.getElementById("edit_note_title").value = note.note_title;
                    document.getElementById("edit_note_tags").value = note.tags;
                    document.getElementById("edit_note_content").value = note.note_body;
                    currentNoteId = noteId;
                    editNoteModal.style.display = "block";
                    document.body.classList.add("modal-open");
                    console.log(currentNoteId)
                })
                .catch(error => console.error('Error fetching note:', error));
        });
    }

    editNoteForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const noteTitle = document.getElementById("edit_note_title").value;
        const tags = document.getElementById("edit_note_tags").value;
        const content = document.getElementById("edit_note_content").value;

        const formData = new FormData();
        formData.append("note_id", currentNoteId);
        formData.append("title", noteTitle);
        formData.append("tags", tags);
        formData.append("content", content);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        fetch('../model/EditNoteModel.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(text => {
            console.log('Respuesta del servidor:', text);
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    alert('Nota actualizada con éxito');
                    editNoteModal.style.display = "none";
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
        .catch(error => console.error('Error al actualizar la nota:', error));
    });

    deleteNoteButton.addEventListener("click", function () {
        if (currentNoteId) {
            fetch('../model/DeleteNoteModel.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `note_id=${currentNoteId}`
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text); });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Nota eliminada con éxito');
                    editNoteModal.style.display = "none";
                    document.body.classList.remove("modal-open");
                    document.querySelector(`.note_card[data-note-id='${currentNoteId}']`).remove();
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error al eliminar la nota:', error));
        } else {
            console.error('No hay nota seleccionada para eliminar.');
        }
    });

    fetch('../model/GetUserNotes.php')
    .then(response => response.json())
    .then(data => {
        console.log("Datos de notas recibidos:", data);
        if (data.error) {
            alert(data.error);
        } else {
            renderNotes(data);
        }
    })
    .catch(error => console.error('Error fetching notes:', error));

    function renderNotes(notes) {
        const notesContainer = document.querySelector('.note_list-container');
        notesContainer.innerHTML = '';

        notes.forEach(note => {
            const noteCard = document.createElement('div');
            noteCard.classList.add('note_card');
            noteCard.dataset.noteId = note.id_note;

            noteCard.innerHTML = `
                <div class="note_summary">
                    <h3 class="note_title">${note.note_title}</h3>
                    <p class="note_date">Fecha de creación: ${note.creation_date}</p>
                    <p class="note_tags">Etiquetas: ${note.tags}</p>
                </div>
                <button id="edit_note">
                    <ion-icon name="pencil-outline"></ion-icon>
                </button>
                <div class="note_detail">
                    <p>${note.note_body}</p>
                </div>
            `;

            notesContainer.appendChild(noteCard);
            addNoteEventListeners(noteCard);
        });
    }
});

