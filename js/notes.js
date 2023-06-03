// Report Notes - Initialise variables
const
addBox                              = document.querySelector(".addNoteBox"),
popupBox                            = document.querySelector(".notePopupBox"),
popupTitle                          = popupBox.querySelector(".popupContent header p"),
closeIcon                           = popupBox.querySelector(".popupContent header span"),
titleText                           = popupBox.querySelector(".popupContent input"),
contentText                         = popupBox.querySelector(".popupContent textarea"),
addButton                           = popupBox.querySelector(".popupContent button");
const months                        = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const notes                         = JSON.parse(localStorage.getItem("adminNotes") || "[]");
let isUpdate                        = false, updateId;

// Fix viewport to Reports panel
function relocate(){ window.location.hash = '#Reports'; }

function focusNote(){ // Open up note window
    popupBox.classList.add("show");
    document.querySelector("body").style.overflow = "hidden";
    if(window.innerWidth > 660) titleText.focus();
}

function editBox(){ // Open up note window with edit note functionality
    setTimeout(function() {
        popupTitle.innerText        = "Update Note";
        addButton.innerText         = "Update Note";
        focusNote();
    }, 500);
}

// Listen for 'Add Note' click event, open up note window with add note functionality
addBox.addEventListener("click", () => {
    setTimeout(function(){
        popupTitle.innerText        = "Add a new Note";
        addButton.innerText         = "Add Note";
        focusNote();
    }, 500);
});

// When the close icon clicked, close the note window
closeIcon.addEventListener("click", () => {
    isUpdate = false;
    titleText.value = contentText.value = "";
    popupBox.classList.remove("show");
    document.querySelector("body").style.overflow = "auto";
});

// Fetch all (if any) notes stored in localStorage, then recreate the HTML elements for the notes
function showNotes(){
    if(!notes) return;
    document.querySelectorAll(".note").forEach(li => li.remove());
    notes.forEach((note, id) => {
        let filterDesc = note.description.replaceAll("\n", '<br/>');
        let liTag = `<li class="note">
                        <div class="noteText">
                            <p>${note.title}</p>
                            <span>${filterDesc}</span>
                        </div>
                        <div class="bottomText">
                            <span>${note.date}</span>
                            <div class="noteSettings">
                                <span onclick="showMenu(this)" class="material-symbols-outlined">more_vert</span>
                                <ul class="noteMenu">
                                    <li onclick="updateNote(${id}, '${note.title}', '${filterDesc}')">
                                        <span class="material-symbols-outlined">edit_note</span>
                                        Edit
                                    </li>
                                    <li onclick="deleteNote(${id})">
                                        <span class="material-symbols-outlined">delete</span>
                                        Delete
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>`;
        addBox.insertAdjacentHTML("afterend", liTag);
    });
}

showNotes(); // Call the above function

// When three dotted menu is clicked, open up menu of note options
function showMenu(elem){
    console.log(elem);
    elem.parentElement.classList.add("show");
    document.addEventListener("click", e => {
        if(e.target.tagName != "SPAN" || e.target != elem){
            elem.parentElement.classList.remove("show");
        }
    });
}

function deleteNote(noteId){    // Delete note function
    function confirmDelete(){   // Delete function and confirmation alert
        Swal.fire({
            title:                  'Are you sure?',
            text:                   "This note will be permanently deleted.",
            icon:                   'warning',
            showCancelButton:       true,
            confirmButtonColor:     '#d33',
            cancelButtonColor:      '#3eb768',
            confirmButtonText:      'Delete'
        }).then((result) => {

            if (result.isConfirmed) { // When delete note confirmed

                // Remove note from localStorage
                notes.splice(noteId, 1);
                localStorage.setItem("adminNotes", JSON.stringify(notes));

                // Fire delete success alert and refresh notes on Report panel
                successAlert("Note Deleted!", "Check Reports Panel.");
                showNotes();
            }
        }); return;
    }

    // Call the above confirm delete function within the delete note function
    confirmDelete();
}

// Update note function - update note title and content
function updateNote(noteId, title, filterDesc){
    let description                 = filterDesc.replaceAll('<br/>', '\r\n');
    updateId                        = noteId;
    isUpdate                        = true;
    editBox();
    titleText.value                 = title;
    contentText.value               = description;
}

// Listen for 'Add Note' button click event
addButton.addEventListener("click", e => {
    e.preventDefault();

    // Retrieve the entered information for note by staff
    let title                       = titleText.value.trim(),
    description                     = contentText.value.trim();

    // Check if either field is set and not empty
    if(title || description) {

        // Get current day
        let currentDate             = new Date(),
        month                       = months[currentDate.getMonth()],
        day                         = currentDate.getDate(),
        year                        = currentDate.getFullYear();

        let noteInfo = { // Initiatlise array for note information
            title,
            description,
            date: `${day} ${month}, ${year}`
        }

        if(!isUpdate){ // When note added, insert note into note info array & success alert
            notes.push(noteInfo);
            successAlert("Note Added!", "Check New Note.");
        } else{ // When note updated, update the note with new details & success alert
            isUpdate                = false;
            notes[updateId]         = noteInfo;
            successAlert("Note Updated!", "Check Updated Note.");
        }

        // Insert notes array to be stored in localStorage
        localStorage.setItem("adminNotes", JSON.stringify(notes));
        showNotes();        // Refresh notes on Report Panel
        closeIcon.click();  // Close the note window
    }
    window.location.href            = "admin-dashboard#Reports"
});