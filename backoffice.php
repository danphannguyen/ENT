<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <title>ENT | Back Office</title>
</head>

<body>

    <?php

    // On démarre la session pour récupérer les variables de session
    session_start();

    // On inclut le fichier contenant les fonctions
    include('./UserModel.php');

    // On vérifie que l'utilisateur est connecté et qu'il est admin
    if (isset($_SESSION['role']) && $_SESSION['role'] == "1") {

        // On vérifie si une action est définie
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case "addUser":
                    // Si on ajout un utilisateurs on récupère les données du formulaire et on les envois à la fonction register
                    $log = register($_POST['newUserEmail'], $_POST['newUserPassword'], $_POST['newUserPrenom'], $_POST['newUserNom'], $_POST['newUserTelephone'], $_POST['newUserRole'], $_POST['newUserTp'], $_POST['newUserPromotion']);
                    break;

                case "deleteUser":
                    // Si on supprime un utilisateur on récupère l'id de l'utilisateur et on l'envois à la fonction deleteUser
                    $log = deleteUser($_POST['idUser']);
                    break;

                case "editUser":
                    // Si on édite un utilisateur on récupère les données du formulaire et on les envois à la fonction editUser
                    $log = editUserAdmin($_POST['idUser'], $_POST['editUserEmail'], $_POST['editUserPrenom'], $_POST['editUserNom'], $_POST['editUserPassword'], $_POST['editUserTelephone'], $_POST['editUserRole'], $_POST['editUserTp'], $_POST['editUserPromotion']);
                    break;

                default:
                    break;
            }
        }
    } else {
        // Si l'utilisateur n'est pas connecté ou qu'il n'est pas admin on le redirige vers la page de connexion
        header('Location: login.php');
    }

    // On récupère les données des fonctions après les avoir traiter au dessus ( ce qui évite un second refresh )
    $allUsers = getAllUsersInfo();
    $allRole = getAllRole();
    $allTp = getAllTp();
    $allPromotion = getAllPromotion();

    ?>

    <nav id="boNav">

        <div id="navMiddle">


            <form action="backoffice.php" method="post">

                <input type="hidden" name="action" value="getUsers">

                <button type="submit" class="BoSubmit">
                    <div class="navIconContainer">
                        <div class="navIconBg">
                            <img src="./svg/boUsers.svg" alt="">
                        </div>
                        <span>Users</span>
                    </div>
                </button>

            </form>

            <form action="backoffice.php" method="post">
                <input type="hidden" name="action" value="getUsers">
                <button type="submit" class="BoSubmit">
                    <div class="navIconContainer">
                        <div class="navIconBg">
                            <img src="./svg/accueil.svg" alt="">
                        </div>
                        <span>Users</span>
                    </div>
                </button>
            </form>

            <form action="backoffice.php" method="post">
                <input type="hidden" name="action" value="getUsers">
                <button type="submit" class="BoSubmit">
                    <div class="navIconContainer">
                        <div class="navIconBg">
                            <img src="./svg/accueil.svg" alt="">
                        </div>
                        <span>Users</span>
                    </div>
                </button>
            </form>

            <form action="backoffice.php" method="post">
                <input type="hidden" name="action" value="getUsers">
                <button type="submit" class="BoSubmit">
                    <div class="navIconContainer">
                        <div class="navIconBg">
                            <img src="./svg/accueil.svg" alt="">
                        </div>
                        <span>Users</span>
                    </div>
                </button>
            </form>

            <form action="backoffice.php" method="post">
                <input type="hidden" name="action" value="getUsers">
                <button type="submit" class="BoSubmit">
                    <div class="navIconContainer">
                        <div class="navIconBg">
                            <img src="./svg/accueil.svg" alt="">
                        </div>
                        <span>Users</span>
                    </div>
                </button>
            </form>

        </div>

    </nav>

    <?php
    // Le switch case ici permet d'afficher la logView selon les actions, ce qui fournis des messsages d'erreurs ou de succès
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case "deleteUser":
                include('./boView/logView.php');
                break;
            case "editUser":
                include('./boView/logView.php');
                break;
            case "addUser":
                include('./boView/logView.php');
                break;
            default:
                break;
        }
    }
    ?>

    <section id="boBody">

        <div class="modalBg">
        </div>

        <?php

        // Le switch case ici permet d'afficher les views en fonctions des actions
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case "getUsers":
                    include('./boView/getUsersView.php');
                    break;
                case "editUser":
                    include('./boView/getUsersView.php');
                    break;
                case "deleteUser":
                    include('./boView/getUsersView.php');
                    break;
                case "addUser":
                    include('./boView/getUsersView.php');
                    break;
                default:
                    echo "Erreur";
                    break;
            }
        } else {
            // Si aucune action n'est définie on affiche la view getUsersView
            include('./boView/getUsersView.php');
        }

        ?>
    </section>


</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./src/backoffice.js"></script>

</html>