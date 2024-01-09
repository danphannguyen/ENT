<?php
require_once 'UserModel.php';

header('Content-Type: application/json');

if (isset($_POST['widgetId'])) {
    $widgetId = $_POST['widgetId'];

    // Ajoutez des logs pour déboguer
    error_log('Suppression du widget ID: ' . $widgetId);

    $deleteWidget = deleteSaveWidget($widgetId);
    echo json_encode(['success' => $deleteWidget]);
} else {
    echo json_encode(['success' => false]);
}
?>