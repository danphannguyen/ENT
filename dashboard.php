<?php
session_start();
require_once 'UserModel.php';


if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$widgets = getAvailableWidgets();

// Charge les widgets enregistrés pour cet utilisateur
$userId = $_SESSION['id'];
$userWidgets = getUserWidgets($userId);
?>

<script>
     var userId = <?php echo json_encode($_SESSION['id']); ?>;  // Récupère le user_id côté serveur
</script>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">

    <title>Dashboard</title>
</head>
<body>


<?php
if (isset($_SESSION['id'])) {
    $result = getUserInfo($_SESSION['id']);
    include('./View/navbarView.php');
} else {
    header('Location: login.php');
}
?>

<section class="dashboard-main">

        <div class="widgetContainer">
        <?php
            // Charger les widgets associés à l'utilisateur actuel
            foreach ($userWidgets as $widget) {
                echo generateWidgetDiv($widget);
            }
        ?>
        </div>

        <div class="add-widget">
            <button id="modalBtn"><img src="./svg/plus.svg" alt="add"></button>
        </div>

        <div id="modal-overlay" class="modal">

            <div class="modal-content">

                <h2>Ajouter un widget</h2>

                <div class="btn-container">
                    <?php
                        foreach ($widgets as $widget) {
                            $iconPath = './svg/' . $widget['widget_content'];
                            echo '<button data-widget-id="' . $widget['widget_id'] . '" class="widget-btn">';
                            echo '<img src="' . $iconPath . '" alt="' . $widget['widget_title'] . '">';
                            echo $widget['widget_title'];
                            echo '</button>';
                        }
                    ?>
                </div>

                <a href="javascript:void(0)" id="modal-exit"><img src="./svg/cross.svg" alt="closebtn"></a>

            </div>

        </div>


</section>


    
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="./js/app.js"></script>
</html>