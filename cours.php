<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css" />
    <title>Document</title>
</head>

<body>

    <?php

    session_start();
    include('./UserModel.php');

    if (isset($_SESSION['id'])) {

        $result = getUserInfo($_SESSION['id']);
        include('./View/navbarView.php');

        $matieres = getMatieres($result[0]['ext_promotions']);

        foreach ($matieres as $matiere) {
            echo $matiere['nom_matiere'] . $matiere['prenom_user'] . $matiere['nom_user'] . '<br>';

            $cours = getCours($matiere['id_matiere']);

            foreach ($cours as $cour) {
                echo $cour['nom_cours'] . '<br>';
            }

        }


    } else {
        header('Location: login.php');
    }

    ?>

</body>

</html>