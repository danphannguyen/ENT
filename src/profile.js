
// ===== Code pour afficher/cacher les modals =====

$("#userInformationButton").click(function () {
    $("#modalBg").fadeIn();
    $("#userInformationModal").fadeIn();
});

$("#userInformationModalClose").click(function () {
    $("#modalBg").fadeOut();
    $("#userInformationModal").fadeOut();
});

$("#userPhotoButton").click(function () {
    $("#modalBg").fadeIn();
    $("#userPhotoModal").fadeIn();
});

$("#userPhotoModalClose").click(function () {
    $("#modalBg").fadeOut();
    $("#userPhotoModal").fadeOut();
});

// ===== Code pour afficher le champ de confirmation de mot de passe =====

var newPasswordInput = $("#newPassword");

// Variable pour suivre si le champ était vide avant
var wasEmpty = true;

// Ajouter un écouteur d'événements pour l'événement "input"
newPasswordInput.on("input", function () {
    // Vérifier si le champ était vide avant la frappe
    if (wasEmpty) {
        console.log("Vous avez commencé à écrire dans newPassword !");
        $("#confirmPasswordContainer").fadeIn();
    }

    // Mettre à jour le statut wasEmpty
    wasEmpty = newPasswordInput.val() === "";
});

// ===== Fonction pour vérifier que les deux champs sont identiques =====

function validateForm() {
    let password = document.forms["editUserInfo"]["newPassword"].value;
    let confirmPassword = document.forms["editUserInfo"]["confirmNewPassword"].value;
    if (password != confirmPassword) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }
}