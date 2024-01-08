<?php
require_once 'usermodel.php';

if (isset($_GET['id'])) {
    $widgetId = $_GET['id'];
    deleteSaveWidget($widgetId);
    header('Location: dashboard.php');
}
?>