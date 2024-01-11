<?php
session_start();
require_once 'UserModel.php';


if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="icon" href="./svg/symbLogo.svg">
    <title>ENT | Cours</title>
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


    <section class="main-modules">
        <div class="modules">
            <?php
            if (isset($_SESSION['id'])) {
                if (isset($_GET['action']) && $_GET['action'] === 'archive') {
                    $matieres = getAllMatieres($result);
                    foreach ($matieres as $matiere) {
                        echo '<div class="matiere">';
                        echo '<div class="module-header"><h2>' . $matiere['nom_matiere'] . '</h2>';
                        echo '<h3>' . $matiere['prenom_user'] . $matiere['nom_user'] . '</h3></div>';

                        echo '<div class="annonce"><p>Annonces:</p></div>';

                        $cours = getCours($matiere['id_matiere']);

                        echo '<ul>';
                        foreach ($cours as $cour) {
                            echo '<li><img src="./svg/document.svg"><a href="#">' . $cour['nom_cours'] . '</a><br>' . '</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                } else {
                    // Sinon, récupérez les matières de la promotion de l'utilisateur connecté
                    $matieres = getMatieres($result[0]['ext_promotions']);
                    foreach ($matieres as $matiere) {
                        echo '<div class="matiere">';
                        echo '<div class="module-header"><h2>' . $matiere['nom_matiere'] . '</h2>';
                        echo '<h3>' . $matiere['prenom_user'] . $matiere['nom_user'] . '</h3></div>';

                        echo '<div class="annonce"><p>Annonces:</p></div>';

                        $cours = getCours($matiere['id_matiere']);

                        echo '<ul>';
                        foreach ($cours as $cour) {
                            echo '<li><img src="./svg/document.svg"><a href="#">' . $cour['nom_cours'] . '</a><br>' . '</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                }
            } else {
                header('Location: login.php');
            }
            ?>
        </div>

        <div class="archivebtn-container">
            <a class="archiveBtn" href="cours.php?action=archive"><button><img src="./svg/archive.svg" alt="archive-icon">Archives de cours</button></a>
        </div>

    </section>

</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="./js/app.js"></script>

</html>