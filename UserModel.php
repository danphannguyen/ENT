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
        return "Mauvaise adresse mail";
    }
}

// Fonction d'inscription
function register($mail, $password, $firstname, $lastname)
{
    if (isMailExist($mail)) {
        return "L adresse mail existe déjà";
    } else {
        if (addUser($mail, $password, $firstname, $lastname)) {
            return 'Inscription réussie';
        } else {
            return 'Erreur lors de l inscription';
        }
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
    $_SESSION['login'] = $result[0]['login_user'];
    $_SESSION['prenom'] = $result[0]['prenom_user'];
    $_SESSION['nom'] = $result[0]['nom_user'];

    return isset($_SESSION['id'], $_SESSION['login'], $_SESSION['prenom'], $_SESSION['nom']);
}

// Ajout d'un utilisateur
function addUser($mail, $password, $firstname, $lastname)
{

    $db = dbConnect();

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (login_user, mdp_user, prenom_user, nom_user) VALUES (:mail, :pswd, :firstname, :lastname)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
    $stmt->bindValue(":pswd", $hash, PDO::PARAM_STR);
    $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    // Exécution de la requête et retourne son état
    return $stmt->execute();
}
