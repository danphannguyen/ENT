<?php

function dbConnect()
{
    return new PDO('mysql:host=109.234.161.199;dbname=dphannguyen_ent;port=3306,charest=utf8', 'dphannguyen_entadmin', 'testbdd01');
}

// Fonction de connexion
function connexion($mail, $password)
{
    if (isMailExist($mail)) {
        if (passwordCheck($mail, $password)) {
            bindUserInfo($mail);
            return "Connexion réussie";
        } else {
            return "Mauvais mot de passe";
        }
    } else {
        return "L'adresse mail n'existe pas";
    }
}

// Vérification de l'existence de l'adresse mail
function isMailExist($mail)
{
    $db = dbConnect();

    $query = "SELECT login_user FROM users where login_user = :mail";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    return !empty($result);
}

// Vérification du mot de passe
function passwordCheck($mail, $password)
{
    $db = dbConnect();

    $query = "SELECT mdp_user FROM users where login_user = :mail";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->execute();
    // renvoyer seulement le PDO statement
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    return password_verify($password, $result[0]['mdp_user']);
}

// Attribution des informations de l'utilisateur à la session
function bindUserInfo($mail)
{

    $db = dbConnect();

    $query = "SELECT * FROM users where login_user = :mail";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->execute();
    // renvoyer seulement le PDO statement
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);

    $_SESSION['id'] = $result[0]['id_user'];
    $_SESSION['role'] = $result[0]['ext_role'];

    return isset($_SESSION['id']);
}

// ===================================================================================================
// ======================================= Fonction CRUD ============================================
// ===================================================================================================

// Récupération de toutes les informations de l'utilisateur
function getUserInfo($id)
{
    $db = dbConnect();

    $query = "SELECT
        users.*,
        tps.nom_tp,
        promotions.nom_promotion,
        roles.nom_role
    FROM
        users
    JOIN
        tps ON users.ext_tp = tps.id_tp
    JOIN
        promotions ON users.ext_promotions = promotions.id_promotion
    JOIN
        roles ON users.ext_role = roles.id_role
    WHERE
        users.id_user = :id_session;";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":id_session", $id, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function getUserAbs($id) {
    $db = dbConnect();

    $query = "SELECT
        absences.*
    FROM
        absences
    JOIN
        users ON absences.ext_user = users.id_user
    WHERE
        users.id_user = :id_session;";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":id_session", $id, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

// Fonction de récupération de tous les rôles
function getAllRole() {
    $db = dbConnect();

    $query = "SELECT * FROM roles";

    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

// Fonction de récupération de tous les TPs
function getAllTp() {
    $db = dbConnect();

    $query = "SELECT * FROM tps";

    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

// Fonction de récupération de toutes les promotions
function getAllPromotion() {
    $db = dbConnect();

    $query = "SELECT * FROM promotions";

    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

// Fonction de récupération de tous les utilisateurs et de toutes leurs informations
function getAllUsersInfo()
{
    $db = dbConnect();

    $query = "SELECT
        users.*,
        tps.nom_tp,
        promotions.nom_promotion,
        roles.nom_role
    FROM
        users
    JOIN
        tps ON users.ext_tp = tps.id_tp
    JOIN
        promotions ON users.ext_promotions = promotions.id_promotion
    JOIN
        roles ON users.ext_role = roles.id_role
    ";

    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

// Fonction d'édition d'un utilisateur
function editUser($id_user, $mail, $firstname, $lastname, $password, $phone) {

    $db = dbConnect();

    // Initialiser la variable $hash à null
    $hash = null;

    // Si $password n'est pas vide, alors générer le hachage
    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }

    $query = "UPDATE users SET login_user = :mail, ";

    // Ajouter le champ password_user uniquement si $password n'est pas vide
    if (!empty($password)) {
        $query .= "mdp_user = :pswd, ";
    }

    $query .= "prenom_user = :firstname, nom_user = :lastname, phone_user = :phone WHERE id_user = :id";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);

    // Ajouter le bind pour le mot de passe uniquement si $password n'est pas vide
    if (!empty($password)) {
        $stmt->bindValue(":pswd", $hash, PDO::PARAM_STR);
    }

    $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindValue(":phone", $phone, PDO::PARAM_STR);
    $stmt->bindValue(":id", $id_user, PDO::PARAM_STR);

    // Exécution de la requête et retourne son état
    return $stmt->execute();

}

// Fonction d'édition d'un utilisateur
function editUserAdmin($id_user, $mail, $firstname, $lastname, $password, $phone, $role, $tp, $promotion) {

    $db = dbConnect();

    // Initialiser la variable $hash à null
    $hash = null;

    // Si $password n'est pas vide, alors générer le hachage
    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }

    $query = "UPDATE users SET login_user = :mail, ";

    // Ajouter le champ password_user uniquement si $password n'est pas vide
    if (!empty($password)) {
        $query .= "mdp_user = :pswd, ";
    }

    $query .= "prenom_user = :firstname, nom_user = :lastname, phone_user = :phone, ext_promotions = :promotion, ext_tp = :tp, ext_role = :role WHERE id_user = :id";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);

    // Ajouter le bind pour le mot de passe uniquement si $password n'est pas vide
    if (!empty($password)) {
        $stmt->bindValue(":pswd", $hash, PDO::PARAM_STR);
    }

    $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindValue(":phone", $phone, PDO::PARAM_STR);
    $stmt->bindValue(":promotion", $promotion, PDO::PARAM_STR);
    $stmt->bindValue(":tp", $tp, PDO::PARAM_STR);
    $stmt->bindValue(":role", $role, PDO::PARAM_STR);
    $stmt->bindValue(":id", $id_user, PDO::PARAM_STR);
    $stmt->execute();

    // Exécution de la requête et retourne son état
    return "L'utilisateur a été modifié avec succès.";

}

// Fonction de suppression d'un utilisateur
function deleteUser($id_user) {
    try {
        $db = dbConnect();

        $query = "DELETE FROM users WHERE id_user = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":id", $id_user, PDO::PARAM_STR);
        $stmt->execute();

        return "L'utilisateur a été supprimé avec succès.";

    } catch (PDOException $e) {
        
        return "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    }

}

// Fonction d'inscription 
function register($mail, $password, $firstname, $lastname, $phonenumber, $role, $tp, $promotion)
{
    if (isMailExist($mail)) {
        return "L adresse mail existe déjà";
    } else {
        if (addUser($mail, $password, $firstname, $lastname, $phonenumber, $role, $tp, $promotion)) {
            return " L'Utilisateur a été ajouté avec succès ";
        } else {
            return "Erreur lors de l'inscription";
        }
    }
}

// Ajout d'un utilisateur dans la base de données
function addUser($mail, $password, $firstname, $lastname, $phonenumber, $role, $tp, $promotion)
{

    $db = dbConnect();

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (login_user, mdp_user, prenom_user, nom_user, phone_user, ext_promotions, ext_tp, ext_role) VALUES (:mail, :pswd, :firstname, :lastname, :phone, :promotion, :tp, :roles)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->bindValue(":pswd", $hash, PDO::PARAM_STR);
    $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindValue(":phone", $phonenumber, PDO::PARAM_STR);
    $stmt->bindValue(":promotion", $promotion, PDO::PARAM_STR);
    $stmt->bindValue(":tp", $tp, PDO::PARAM_STR);
    $stmt->bindValue(":roles", $role, PDO::PARAM_STR);
    // Exécution de la requête et retourne son état
    return $stmt->execute();
}

// Fonction de modification du path de la photo de profil
function editUserPhoto ($id_user, $path) {

    $db = dbConnect();

    $query = "UPDATE users SET photo_user = :photo WHERE id_user = :id";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":photo", $path, PDO::PARAM_STR);
    $stmt->bindValue(":id", $id_user, PDO::PARAM_STR);

    // Exécution de la requête et retourne son état
    return $stmt->execute();

}

// Fonction de modification de la photo de profil dans le dossier /uploads
function addImage($id, $image)
{
    $uploadDir = "uploads/";
    $newFileName = "user_" . $id . ".png";
    $uploadFile = $uploadDir . basename($newFileName);

    // Déplacez le fichier vers le répertoire d'upload
    if (move_uploaded_file($image, $uploadFile)) {
        return $uploadFile;
    } else {
        return "";
    }
}

// Fonction de modification de la photo de profil dans le dossier /uploads
function addJustifImage($id, $image)
{
    $uploadDir = "uploads/";
    $newFileName = "Justif_" . $id . ".png";
    $uploadFile = $uploadDir . basename($newFileName);

    // Déplacez le fichier vers le répertoire d'upload
    if (move_uploaded_file($image, $uploadFile)) {
        return $uploadFile;
    } else {
        return "";
    }
}

// Fonction de modification du path de la photo de profil
function editUserJustif ($id_abs, $path) {

    $db = dbConnect();

    $query = "UPDATE absences SET justificationphoto = :photo, isjustifie = :isjustifie WHERE id_absence = :id";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":photo", $path, PDO::PARAM_STR);
    $stmt->bindValue(":isjustifie", 1, PDO::PARAM_STR);
    $stmt->bindValue(":id", $id_abs, PDO::PARAM_STR);

    // Exécution de la requête et retourne son état
    return $stmt->execute();

}