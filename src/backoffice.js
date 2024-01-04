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

// ===== Code pour afficher le champ de confirmation de mot de passe =====

var newPasswordInput = $("#newUserPassword");

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
    let password = document.forms["NewUserInfo"]["newUserPassword"].value;
    let confirmPassword = document.forms["NewUserInfo"]["confirmNewUserPassword"].value;

    // Vérification que les deux champs sont identiques
    if (password != confirmPassword) {

        // Si les deux champs ne sont pas identiques, afficher une alerte et empêcher la soumission du formulaire
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }
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