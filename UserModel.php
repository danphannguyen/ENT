<?php

function dbConnect()
{
    return new PDO('mysql:host=localhost;dbname=dphannguyen_ent;port=8889', 'root', 'root');
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


// ===================================================================================================
// ======================================= Fonction Register =========================================
// ===================================================================================================


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

//=================fonction pour ajouter des widgets 

function deleteSaveWidget($widgetId)
{
    session_start();
    try {
        $db = dbConnect();
        $delete = $db->prepare('DELETE FROM save_widget WHERE user_id = ? AND save_widget_id = ?');
        $delete->execute(array($_SESSION['id'], $widgetId));
        return $_SESSION['id'] . ' ' . $widgetId;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getAvailableWidgets()
{
    $db = dbConnect();
    $reqWidgets = $db->query('SELECT * FROM widget');
    return $reqWidgets->fetchAll();
}

function saveUserWidget($userId, $widgetId)
{
    $db = dbConnect();
    $insert = $db->prepare('INSERT INTO save_widget(user_id, widget_id) VALUES(?, ?)');
    $insert->execute(array($userId, $widgetId));
    return true;
}

function getUserWidgets($userId)
{
    $db = dbConnect();
    $reqWidgets = $db->prepare('SELECT * FROM save_widget WHERE user_id = ?');
    $reqWidgets->execute(array($userId));
    return $reqWidgets->fetchAll();
}

function generateWidgetDiv($widgetUser)
{
    $db = dbConnect();
    $reqWidget = $db->prepare('SELECT * FROM widget WHERE widget_id = ?');
    $reqWidget->execute(array($widgetUser['widget_id']));
    $widget = $reqWidget->fetch(PDO::FETCH_ASSOC);

    if ($widget) {
        $img = './img/' . $widget['widget_img'];

        return '<div class="widget-container" data-widget-id="' . $widgetUser['save_widget_id'] . '">
                    <button class="delete-widget" onclick="deleteWidget(this.parentNode)"><img src="./svg/trash.svg" alt="delete"></button>
                    <div class="widget-header">
                        <a class="goto" href="' . $widget['widget_link'] . '"><img src="./svg/goto.svg" alt="link to"></a>
                        <h3>' . $widget['widget_title'] . '</h3>
                    </div>
                    <div class="widget-content">
                        <img src="' . $img . '" alt="' . $widget['widget_title'] . '">
                    </div>
                </div>';
    }
}