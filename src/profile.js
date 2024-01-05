
// ===== Code pour afficher/cacher les modals =====
// Aux click sur les boutons, afficher les modals correspondantes avec des fadeIn() et fadeOut()

$("#userInformationButton").click(function () {
    $(".modalBg").fadeIn();
    $("#userInformationModal").fadeIn();
});

$("#userInformationModalClose").click(function () {
    $(".modalBg").fadeOut();
    $("#userInformationModal").fadeOut();
});

$("#userPhotoButton").click(function () {
    $(".modalBg").fadeIn();
    $("#userPhotoModal").fadeIn();
});

$("#userPhotoModalClose").click(function () {
    $(".modalBg").fadeOut();
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

        // Si c'est la première fois que l'utilisateur écrit dans le champ, afficher le champ de confirmation
        $(".confirmPasswordContainer").fadeIn();
    }

    // Mettre à jour le statut wasEmpty
    wasEmpty = newPasswordInput.val() === "";
});

// ===== Fonction pour vérifier que les deux champs sont identiques =====

function validateForm() {
    // récupération des valeurs des champs
    let password = document.forms["editUserInfo"]["newPassword"].value;
    let confirmPassword = document.forms["editUserInfo"]["confirmNewPassword"].value;

    if (password.trim() === "") {
        // Le mot de passe est vide, aucune vérification supplémentaire nécessaire
        return true;
    }

    // Vérifier la longueur minimale (8 caractères)
    if (password.length < 8) {
        alert("Le mot de passe doit avoir au moins 8 caractères.");
        return false;
    }

    // Vérifier la présence d'au moins une lettre majuscule, une lettre minuscule et un chiffre
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
    if (!regex.test(password)) {
        alert("Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.");
        return false;
    }

    // Vérification que les deux champs sont identiques
    if (password != confirmPassword) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }

    // Le mot de passe est valide
    // alert("Le mot de passe est valide !");
    return true;

}