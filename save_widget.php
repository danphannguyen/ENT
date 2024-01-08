<?php
require_once 'usermodel.php';

if (isset($_GET['id'])) {
    $widgetId = $_GET['id'];
    saveUserWidget($_SESSION['id'], $widgetId);
    header('Location: dashboard.php');
}
?>