//Modal

function toggleModal() {
    let modal = document.getElementById("modal-overlay");
    modal.classList.toggle("open");
}

document.getElementById("modalBtn").addEventListener("click", toggleModal);

document.getElementById("modal-exit").addEventListener("click", toggleModal);


// Fonction pour sauvegarder un widget côté serveur
function saveWidget(widgetId) {

    window.location.href = "save_widget.php?id=" + widgetId;
}

// Création des widgets
function selectWidget(widgetId) {
    console.log('Widget sélectionné :', widgetId);

    var existingWidgets = document.querySelectorAll('.widget-container[data-widget-id="' + widgetId + '"]');
    if (existingWidgets.length > 0) {
        alert("Ce widget est déjà ajouté !");
        return;
    }

   var widgetDiv = document.createElement('div');
    widgetDiv.classList.add('widget-container');
    widgetDiv.setAttribute('data-widget-id', widgetId);

    switch (widgetId) {
        case '1':
            widgetDiv.classList.add('widget');
            widgetDiv.innerHTML = `
            <button class="delete-widget" onclick="deleteWidget(this.parentNode)"><img src="./svg/trash.svg" alt="delete"></button>
                <div class="widget-header">
                    <a class="goto" href="calendrier.php"><img src="./svg/goto.svg" alt="link to"></a>
                    <h3>Calendrier</h3>
                </div>
                <div class="widget-content">
                    <img src="./img/ADE.png" alt="ADE">
                </div>`;
            break;
        case '2':
            widgetDiv.classList.add('widget');
            widgetDiv.innerHTML = `
            <button class="delete-widget" onclick="deleteWidget(this.parentNode)"><img src="./svg/trash.svg" alt="delete"></button>
                <a class="goto" href="crous.php"><img src="./svg/goto.svg" alt="link to"></a>
                <div class="widget-header">
                    <h3>Crous</h3>
                </div>
                <div class="widget-content">
                    <img src="./img/Crous.png" alt="Crous">
                </div>`;
            break;
        case '3':
            widgetDiv.classList.add('widget');
            widgetDiv.innerHTML = `
            <button class="delete-widget" onclick="deleteWidget(this.parentNode)"><img src="./svg/trash.svg" alt="delete"></button>
                <div class="widget-header">
                <a class="goto" href="note.php"><img src="./svg/goto.svg" alt="link to"></a>
                    <h3>Notes</h3>
                </div>
                <div class="widget-content">
                    <img src="./img/Note.png" alt="Note">
                </div>`;
            break;
        case '4':
            widgetDiv.classList.add('widget');
            widgetDiv.innerHTML = `
            <button class="delete-widget" onclick="deleteWidget(this.parentNode)"><img src="./svg/trash.svg" alt="delete"></button>
                <div class="widget-header">
                <a class="goto" href="emploi.php"><img src="./svg/goto.svg" alt="link to"></a>
                    <h3>Cours</h3>
                </div>
                <div class="widget-content">
                    <img src="./img/cours.png" alt="cours">
                </div>`;
            break;
    }

    var widgetContainer = document.querySelector('.widgetContainer');
    widgetContainer.appendChild(widgetDiv);

    // Enregistre le widget côté serveur
    saveWidget(widgetId);

    toggleModal();
}

function deleteWidget(widget) {
    var widgetIdToDelete = widget.getAttribute('data-widget-id');

    // Supprime le widget côté client
    widget.remove();

    // Supprime le widget côté serveur
    window.location.href = "delete_widget.php?id=" + widgetIdToDelete;
}

// Écouteurs d'événements pour chaque bouton de widget
var widgetButtons = document.querySelectorAll('.btn-container .widget-btn');
widgetButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        var widgetId = this.getAttribute('data-widget-id');
        selectWidget(widgetId);
    });
});

