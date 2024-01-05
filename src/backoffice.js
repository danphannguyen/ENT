// ===== Code pour afficher/cacher les modals =====
// Aux click sur les boutons, afficher les modals correspondantes avec des fadeIn() et fadeOut()

$("#boAddButton").click(function () {
    $(".modalBg").fadeIn();
    $("#addUserModal").fadeIn();
});

$("#userInformationModalClose").click(function () {
    $(".modalBg").fadeOut();
    $("#addUserModal").fadeOut();
});

$(".editTool").click(function () {
    let buttonId = $(this).attr("id");
    let userId = "#" + buttonId.replace("Button", "Modal");

    $(".modalBg").fadeIn();
    $(userId).fadeIn();
});

$(".profilModalClose").click(function () {
    let modalId = $(this).attr("data-id");
    modalId = "#editModalUser" + modalId;

    $(".modalBg").fadeOut();
    $(modalId).fadeOut();
});

// ===== Code pour afficher le champ de confirmation de mot de passe =====

var newPasswordInput = $("#newUserPassword");

// Variable pour suivre si le champ était vide avant
var wasEmpty = true;

// Ajouter un écouteur d'événements pour l'événement "input"
newPasswordInput.on("input", function () {
    // Vérifier si le champ était vide avant la frappe
    if (wasEmpty) {
        // Si c'est la première fois que l'utilisateur écrit dans le champ, afficher le champ de confirmation
        $("#newUserConfirm").fadeIn();
    }

    // Mettre à jour le statut wasEmpty
    wasEmpty = newPasswordInput.val() === "";
});

$('.editUserPassword').on('input', function () {
    id = $(this).attr('id')
    id = id.replace('User', 'Confirm')

    // Vérifier si le champ était vide avant la frappe
    if (wasEmpty) {
        // Si c'est la première fois que l'utilisateur écrit dans le champ, afficher le champ de confirmation
        $("#" + id).fadeIn();
    }

    // Mettre à jour le statut wasEmpty
    wasEmpty = newPasswordInput.val() === "";
});

// ===== Fonction pour vérifier que les deux champs sont identiques =====

function validateForm() {
    // récupération des valeurs des champs
    let password = document.forms["NewUserInfo"]["newUserPassword"].value;
    let confirmPassword = document.forms["NewUserInfo"]["confirmNewUserPassword"].value;

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
    return true;
}

function validateEditForm(id) {

    let editPassword = document.getElementById('editUserPassword' + id).value
    let editConfirmPassword = document.getElementById('confirmEditUserPassword' + id).value

    // Vérifier si le mot de passe est vide
    if (editPassword.trim() === "") {
        // Le mot de passe est vide, aucune vérification supplémentaire nécessaire
        return true;
    }

    // Vérifier la longueur minimale (8 caractères)
    if (editPassword.length < 8) {
        alert("Le mot de passe doit avoir au moins 8 caractères.");
        return false;
    }

    // Vérifier la présence d'au moins une lettre majuscule, une lettre minuscule et un chiffre
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
    if (!regex.test(editPassword)) {
        alert("Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.");
        return false;
    }

    // Vérification que les deux champs sont identiques
    if (editPassword != editConfirmPassword) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }

    // Le mot de passe est valide
    return true;
}

// ===== Fonction pour confirmer la suppression d'un utilisateur =====

// Ajouter un écouteur d'événements pour l'événement "submit" sur les formulaires de suppression
$(".deleteForm").submit(function (event) {

    // Empêcher la soumission du formulaire
    event.preventDefault();

    // Afficher une boîte de dialogue de confirmation
    let confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");

    // Si l'utilisateur clique sur OK, soumettre le formulaire
    if (confirmation) {
        this.submit();
    }
});