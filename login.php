<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <title>Université Gustave Eiffel</title>
</head>

<body>

    <?php
    session_start();

    // Include du fichiers contenant toute les fonctions
    include('./UserModel.php');

    // switch case pour traiter la connexion
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'login') {
            // Si c'est login on teste la connexion

            $result = connexion($_POST['mailLogin'], $_POST['passwordLogin']);

        } else {
            echo "Erreur";
        }
    }

    ?>

    <div id="headerConnexion">
        <img src="./svg/symbLogo.svg" alt="">
        <img src="./svg/typoLogo.svg" alt="">
    </div>

    <section id="sectionConnexion">
        <div id="containerConnexion" class="dc-center">

            <!-- AFFICHER LES ERREURS EN PHP  -->
            <?php

            if (isset($_POST['action'])) {

                // Si la connexion est réussie et que l'id est set on redirige vers l'accueil
                if($result == "Connexion réussie" && isset($_SESSION['id'])) {
                    userOnline($_SESSION['id']);
                    header('Location: accueil.php');
                }

                // Si la connexion n'est pas réussie ou que l'id n'est pas set on affiche un message d'erreur
                echo '
                <span id="spanLog">' . $result . '</span>
                ';
            }

            ?>


            <h1>Connexion</h1>

            <form id="formConnexion" class="dc-center" action="login.php" method="post">

                <input type="hidden" name="action" value="login">

                <div class="inputFormConnexion">
                    <input aria-label="email" type="email" name="mailLogin" id="mailConnexion" placeholder="Email" required>
                </div>

                <div class="inputFormConnexion">
                    <input aria-label="mot de passe" type="password" name="passwordLogin" id="passwordConnexion" placeholder="Mot de passe" required>
                    <div id="eyeButton">
                        <img id="eyeImg" src="./svg/show.svg" alt="">
                    </div>
                </div>

                <div id="submitContainerConnexion" class="dc-center">
                    <input type="submit" value="Se connecter">
                    <a href="">Mot de passe oublié ?</a>
                </div>
            </form>

        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        // Script pour afficher ou cacher le mot de passe
        const togglePassword = document.querySelector('#eyeButton');
        const password = document.querySelector('#passwordConnexion');
        var image = document.getElementById("eyeImg");
        var isImage1 = true;

        togglePassword.addEventListener('click', function(e) {

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.classList.toggle('bi-eye');

            if (isImage1) {
                image.src = "./svg/hide.svg";
            } else {
                image.src = "./svg/show.svg";
            }

            // Invert the state for the next click
            isImage1 = !isImage1;
        });
    </script>

</body>

</html>