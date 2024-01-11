<?php
require_once './UserModel.php';

if (isset($_GET['user_id']) && isset($_GET['widget_id'])) {
    $userId = $_GET['user_id'];
    $widgetId = $_GET['widget_id'];
    
    // Vérifiez si le widget n'est pas déjà enregistré pour cet utilisateur
    $userWidgets = getUserWidgets($userId);
    if (!in_array($widgetId, $userWidgets)) {
        saveUserWidget($userId, $widgetId);
    }
    
    header('Location: dashboard.php');
}
?>