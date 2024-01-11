<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <title>ENT | Notes</title>
</head>

<body>

    <?php
    session_start();

    include('./UserModel.php');

    if (isset($_SESSION['id'])) {
        $result = getUserInfo($_SESSION['id']);
        include('./View/navbarView.php');

        // Récupérer les notes de l'utilisateur
        $resultats = getNotes($_SESSION['id']);

        if (count($resultats) > 0) {

            // Récupérer la moyenne générale de l'utilisateur
            $moyenne_generale = getMoyenneGenerale($_SESSION['id']);
            $moyenne_generale_formattee = number_format($moyenne_generale, 2);

            // Traitez les résultats pour les regrouper par ext_matiere
            $notes_par_matiere = array();
            foreach ($resultats as $resultat) {
                $ext_matiere = $resultat['ext_matiere'];
                if (!isset($notes_par_matiere[$ext_matiere])) {
                    $notes_par_matiere[$ext_matiere] = array();
                }
                $notes_par_matiere[$ext_matiere][] = $resultat;
            }
        } else {

            // Si l'utilisateur n'a pas de notes ne rien affiché
            $notes_par_matiere = array();
            $moyenne_generale_formattee = 0;
        }

    } else {
        header('Location: login.php');
    }
    ?>

    <div id="notesAsideContainer">


        <div id="notesAsideHeader">
            <div id="notesAsideHeaderOne" class="notesAsideContent">
                <span>Moyenne générale classe</span>
                <span>14,50</span>
            </div>
            <div id="notesAsideHeaderTwo" class="notesAsideContent">
                <span>Moyenne la plus élevée</span>
                <span>19,33</span>
            </div>
            <div id="notesAsideHeaderThree" class="notesAsideContent">
                <span>Moyenne la plus basse</span>
                <span>2,47</span>
            </div>
        </div>

        <div id="notesAsideFooter">
            <div id="notesAsideFooterOne" class="notesAsideContent">
                <span>Ma moyenne générale</span>
                <span> <?php echo $moyenne_generale_formattee ?> </span>
            </div>
        </div>

    </div>

    <section id="notesSection">
        <div id="notesHeaderSection">
            <h1>Mes Notes</h1>

            <div id="notesBackButton">
                <a href="./accueil.php">
                    <img src="./svg/arrow-left.svg" alt="back">
                    <span>Retour</span>
                </a>
            </div>
        </div>

        <div id="notesWrapper">

            <?php

            // Affichez les résultats
            foreach ($notes_par_matiere as $ext_matiere => $notes) {

                // Récupérer le nom de la matiere
                $matiere = getNameMatiere($ext_matiere);

                // Calculer la moyenne de la matière
                $moyenne = getMoyenneMatiere($ext_matiere, $_SESSION['id']);
                $moyenne_formatte = number_format($moyenne, 2);

                echo '<div class="notesTemplateContainer">';
                echo '<div class="notesTemplateHeader">';
                echo '<span>' . $matiere . '</span>';
                echo '<span>' . $moyenne_formatte . '</span>';
                echo '</div>';
                echo '<div class="notesTemplateContent">';
                foreach ($notes as $note) {

                    $date_obj = new DateTime($note['date_note']);
                    $date_formattee = $date_obj->format('d/m/Y');

                    $note_formattee = number_format($note['note'], 2);

                    echo '<div class="notesTemplate">';
                    echo '<div class="notesTemplateLeft">';
                    echo '<span>le ' . $date_formattee . '</span>';
                    echo '<span>Moy. classe : 14,50</span>';
                    echo '</div>';
                    echo '<span>' . $note_formattee . '</span>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }

            ?>
        </div>

    </section>



</body>

</html>