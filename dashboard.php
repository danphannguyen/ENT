<?php
require_once 'usermodel.php';

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$widgets = getAvailableWidgets();

// Charge les widgets enregistrés pour cet utilisateur
$userId = $_SESSION['id'];
$userWidgets = getUserWidgets($userId);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">

    <title>Dashboard</title>
</head>
<body>

    <nav>

        <div class="navTop">
            <a href="">
                <div class="navIconBg2">
                    <img id="navIconLogo" src="./svg/SymbLogo.svg" alt="">
                </div>
            </a>
        </div>

        <div id="navMiddle">
            <a href="accueil.php">
                <div class="navIconContainer">
                    <div class="navIconBg">
                        <img src="./svg/accueil.svg" alt="">
                    </div>
                    <span>Accueil</span>
                </div>
            </a>
            <a href="dashboard.php">
                <div class="navIconContainer">
                    <div class="navIconBg">
                        <img src="./svg/dashboard.svg" alt="">
                    </div>
                    <span>Dashboard</span>
                </div>
            </a>
            <a href="#">
                <div class="navIconContainer">
                    <div class="navIconBg">
                        <img src="./svg/calendirer.svg" alt="">
                    </div>
                    <span>Calendrier</span>
                </div>
            </a>
            <a href="#">
                <div class="navIconContainer">
                    <div class="navIconBg">
                        <img src="./svg/cours.svg" alt="">
                    </div>
                    <span>Cours</span>
                </div>
            </a>
            <a href="#">
                <div class="navIconContainer">
                    <div class="navIconBg">
                        <img src="./svg/chat.svg" alt="">
                    </div>
                    <span>Chat</span>
                </div>
            </a>
        </div>

        <div class="navBottom">
            <a href="">
                <div class="navIconBg2">
                    <img src="./svg/profile.svg" alt="">
                </div>
            </a>
        </div>

    </nav>


<section class="dashboard-main">

        <div class="widgetContainer">

            <?php
                foreach ($userWidgets as $userWidget) {
                    $widgetId = $userWidget['widget_id'];
                    $widget = getUserWidgets($widgetId);
                    $iconPath = './svg/' . $widget['widget_content'];
                    echo '<div class="widget">';
                    echo '<a href="delete_widget.php?id=' . $widgetId . '"><img class="delete-widget" src="./svg/cross.svg" alt="delete"></a>';
                    echo '<img src="' . $iconPath . '" alt="' . $widget['widget_title'] . '">';
                    echo '<h3>' . $widget['widget_title'] . '</h3>';
                    echo '</div>';
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

<script src="./js/app.js"></script>
</html>