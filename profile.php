<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="icon" href="./svg/symbLogo.svg">
    <title>ENT | Profile</title>
</head>

<body>

    <?php

    // On démarre la session pour récupérer les variables de session
    session_start();

    // On inclut le fichier contenant les fonctions
    include('./UserModel.php');

    // On vérifie que l'utilisateur est connecté et qu'il est admin
    if (isset($_SESSION['id'])) {

        // On actualise d'abord les informations en cas de changements
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'editUserPhoto':
                    // On vérifie si une image est envoyé
                    if (isset($_FILES["profilePictureFile"]) && $_FILES["profilePictureFile"]["error"] == 0) {
                        // On ajoute l'image et on récupère le path
                        $path = addImage($_SESSION['id'], $_FILES["profilePictureFile"]["tmp_name"]);
                    } else {
                        // Si aucune image n'est envoyé on met le path par défaut
                        $path = "./svg/profile.svg";
                    }
                    // On envois le path à la fonction editUserPhoto
                    $result = editUserPhoto($_SESSION['id'], $path);
                    break;

                case 'editUserInfo':
                    // On envois les données à la fonction editUser
                    $result = editUser($_SESSION['id'], $_POST['email'], $_POST['prenom'], $_POST['nom'], $_POST['newPassword'], $_POST['telephone']);
                    break;

                case 'editUserJustif':
                    // On vérifie si une image est envoyé
                    if (isset($_FILES["JustifPictureFile"]) && $_FILES["JustifPictureFile"]["error"] == 0) {
                        // On ajoute l'image et on récupère le path
                        $path = addJustifImage($_POST['id_absence'], $_FILES["JustifPictureFile"]["tmp_name"]);

                        // On envois le path à la fonction editUserJustif
                        $result = editUserJustif($_POST['id_absence'], $path);
                    } else {
                        $result = "Erreur lors de l'ajout de l'image";
                    }


                    break;


                case 'logout':
                    // Si c'est une déconnexion, on unset les variables de session + session destroy + redirection vers la page de connexion
                    userOffline($_SESSION['id']);
                    unset(
                        $_SESSION['id'],
                        $_SESSION['role'],
                    );
                    session_destroy();
                    header('Location: login.php');
                    break;

                default:
                    echo "Erreur";
                    break;
            }
        }

        // Puis on les récupères
        $result = getUserInfo($_SESSION['id']);
        $abs = getUserAbs($_SESSION['id']);

        // On Créer un tableau pour récupèrer les durées d'absence groupées par justification
        $dureesGroupedByJustification = array(
            '0' => 0, // Durées pour isjustifie = 0
            '1' => 0, // Durées pour isjustifie = 1
            '2' => 0  // Durées pour isjustifie = 2
        );

    } else {

        // Si l'utilisateur n'est pas connecté ou qu'il n'est pas admin on le redirige vers la page de connexion
        header('Location: login.php');
    }

    include('./View/navbarView.php');

    ?>

    <section id="profileSection">

        <div id="profileBodyContainer">

            <div id="profileBodyDiv1">

                <div class="profileBodyLabel">
                    <h1>Coordonnées</h1>
                </div>

                <button id="userPhotoButton" class="profileBodyEdit">
                    <img src="./svg/edit.svg" alt="changer votre informations">
                </button>

                <div id="profileInfo1">

                    <img id="profilePicture" src="<?php echo $result[0]['photo_user']; ?>" alt="">

                    <div id="profileHeader">
                        <h1> <?php echo $result[0]['prenom_user'] . " " . $result[0]['nom_user'] ?> </h1>

                        <form action="profile.php" method="post">
                            <button type="submit">
                                <img src="./svg/disconnect.svg" alt="Logout">
                            </button>

                            <input type="hidden" name="action" value="logout">
                        </form>

                    </div>
                    <div class="hr"></div>

                    <div class="profileTextContainer">
                        <div class="profileText">
                            <img class="profileIcon" src="./svg/school.svg" alt="">
                            <span>IUT Marne la Vallée - Campus Champs sur Marne</span>
                        </div>
                        <div class="profileText">
                            <img class="profileIcon" src="./svg/cours.svg" alt="">
                            <!-- CHANGER TP + PROMOTION -->
                            <?php
                            if ($result[0]['nom_tp'] == "PSL") {
                                echo " <span>" . $result[0]['nom_role'] . " au sein de l'IUT</span>";
                            } else {
                                echo " <span>BUT " . $result[0]['nom_promotion'] . ' - ' . $result[0]['nom_tp'] . "</span>";
                            }


                            ?>
                        </div>
                    </div>

                </div>

            </div>

            <div id="profileBodyDiv2">

                <div class="profileBodyLabel">
                    <h1>Sécurité du Compte</h1>
                </div>

                <button id="userInformationButton" class="profileBodyEdit">
                    <img src="./svg/edit.svg" alt="changer votre photo de profile">
                </button>

                <div id="profileInfo2">
                    <div class="profileInfo2Text">
                        <span>Identifiant</span>
                        <span class="regularText"><?php echo $result[0]['prenom_user'] . " " . $result[0]['nom_user'] ?></span>
                    </div>
                    <div class="hr"></div>
                    <div class="profileInfo2Text">
                        <span>Mot de passe</span>
                        <span class="regularText">******************</span>
                    </div>
                    <div class="hr"></div>
                    <div class="profileInfo2Text">
                        <span>Courriel Universitaire</span>
                        <span class="regularText"><?php echo $result[0]['login_user'] ?></span>
                    </div>
                    <div class="hr"></div>
                    <div class="profileInfo2Text">
                        <span>Téléphone</span>
                        <span class="regularText"><?php echo $result[0]['phone_user'] ?></span>
                    </div>
                </div>

            </div>

        </div>

        <div id="profileAsideContainer">

            <div class="asideDiv">
                <div class="asideDivTitle">
                    <h1>Détails d’absences</h1>
                </div>

                <div class="asideBodyContainer">

                    <?php

                    if (empty($abs)) {
                        echo '
                            <div class="absTemplate">
                                <div class="absPartOne">
                                    <img class="absIcon" src="./svg/right.svg" alt="">
                                    <span> Aucune absence</span>
                                </div>
                            </div>
                        ';
                    }


                    foreach ($abs as $ab) {

                        // Permet d'avoir l'heure au format 24h
                        $heureDebutFormatee = date("G\hi", strtotime($ab['debut_absence']));
                        $heureFinFormatee = date("G\hi", strtotime($ab['fin_absence']));
                        $dureeFormatee = date("G\hi", strtotime($ab['duree_absence']));

                        // Créer un objet DateTime à partir de la date de l'absence
                        $dateObj = new DateTime($ab['date_absence']);

                        // Créer un formateur de date avec la locale en français
                        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);

                        // Formater la date selon le format souhaité
                        $dateFormatee = $dateFormatter->format($dateObj);

                        switch ($ab['isjustifie']) {
                            case 0:
                                $svgPath = "./svg/wrong.svg";
                                break;
                            case 1:
                                $svgPath = "./svg/waiting.svg";
                                break;
                            case 2:
                                $svgPath = "./svg/right.svg";
                                break;
                            default:
                                $svgPath = "./svg/right.svg";
                                break;
                        }

                        if ($ab['isjustifie'] == 0) {
                            echo '
                            <div class="absTemplate">
                                <button data-id="' . $ab['id_absence'] . '"  class="justifButton">
                                    <div class="absPartOne">
                                        <img class="absIcon" src="' . $svgPath . '" alt="">
                                        <span> Absence ' . $dateFormatee . '</span>
                                    </div>
                                    <div class="absPartTwo">
                                        <span>De ' . $heureDebutFormatee . ' à ' . $heureFinFormatee . ' - ' . $dureeFormatee . ' heures</span>
                                    </div>
                                </button>
                            </div>
                        ';
                        } else {
                            echo '
                            <div class="absTemplate">
                                    <div class="absPartOne">
                                        <img class="absIcon" src="' . $svgPath . '" alt="">
                                        <span> Absence ' . $dateFormatee . '</span>
                                    </div>
                                    <div class="absPartTwo">
                                        <span>De ' . $heureDebutFormatee . ' à ' . $heureFinFormatee . ' - ' . $dureeFormatee . ' heures</span>
                                    </div>
                            </div>
                        ';
                        }

                        // ==== Calcul des durées d'absence groupées par justification ====
                        // Convertir la durée d'absence en secondes
                        $dureeEnSecondes = strtotime($ab['duree_absence']) - strtotime('00:00:00');

                        // Ajouter la durée au total correspondant à l'état de justification
                        $dureesGroupedByJustification[$ab['isjustifie']] += $dureeEnSecondes;
                    }

                    // Permet d'avoir le total de toutes les heures d'absences sans groupements
                    $totalDuree = $dureesGroupedByJustification[0] + $dureesGroupedByJustification[1] + $dureesGroupedByJustification[2];

                    ?>

                </div>



            </div>

            <div class="asideDiv">
                <div class="asideDivTitle">
                    <h1>Récapitulatif d’absences</h1>
                </div>

                <div class="asideBodyContainer">

                    <div class="absTemplate">
                        <div class="absPartOne">
                            <img class="absIcon" src="./svg/right.svg" alt="">
                            <span>Absences justifiées</span>
                        </div>


                        <div class="absPartTwo">
                            <span>Total de - <?php echo date("H:i", $dureesGroupedByJustification[1])  ?> heures</span>
                        </div>

                    </div>

                    <div class="absTemplate">
                        <div class="absPartOne">
                            <img class="absIcon" src="./svg/wrong.svg" alt="">
                            <span>Absences non justifiées</span>
                        </div>


                        <div class="absPartTwo">
                            <span>Total de - <?php echo date("H:i", $dureesGroupedByJustification[0])  ?> heures</span>
                        </div>

                    </div>

                    <div class="absTemplate">
                        <div class="absPartOne">
                            <img class="absIcon" src="./svg/waiting.svg" alt="">
                            <span>Absence en cours de vérification</span>
                        </div>


                        <div class="absPartTwo">
                            <span>Total de - <?php echo date("H:i", $dureesGroupedByJustification[2])  ?> heures </span>
                        </div>

                    </div>

                    <div id="absRecap">
                        <div class="recapTemplate">
                            <div class="recapPartOne">
                                <span>Total d’absences :</span>
                            </div>


                            <div class="recapPartTwo">
                                <span> <?php echo date("H:i", $totalDuree) ?> heures</span>
                            </div>

                        </div>
                    </div>

                </div>



            </div>

        </div>

    </section>

    <section id="modalSection">

        <div class="modalBg">
        </div>

        <div id="userInformationModal" class="profileModalContainer">
            <div class="profileModal">

                <div class="profilModalTitle">
                    <h1>Modifier le profile</h1>
                    <button id="userInformationModalClose" class="profilModalClose">X</button>
                </div>

                <div class="profileModalFormContainer">
                    <form name="editUserInfo" onsubmit="return validateForm()" class="profileModalForm" action="profile.php" method="post">

                        <input type="hidden" name="action" value="editUserInfo">

                        <div class="profilInputContainer firstLastNameInput">
                            <div>
                                <label for="prenom">Prénom :</label>
                                <input type="text" id="prenom" name="prenom" value="<?php echo $result[0]['prenom_user'] ?>" required>
                            </div>

                            <div>
                                <label for="nom">Nom :</label>
                                <input type="text" id="nom" name="nom" value="<?php echo $result[0]['nom_user'] ?>" required>
                            </div>
                        </div>

                        <div class="profilInputContainer">
                            <label for="newPassword">Nouveau mot de passe :</label>
                            <input type="password" id="newPassword" name="newPassword">
                        </div>

                        <div class="profilInputContainer confirmPasswordContainer">
                            <label for="confirmNewPassword">Confirmer le mot de passe:</label>
                            <input type="password" id="confirmNewPassword" name="confirmNewPassword" aria-label="Confirmer votre mdp">
                        </div>

                        <div class="profilInputContainer">
                            <label for="email">Courriel Universitaire :</label>
                            <input type="email" id="email" name="email" value="<?php echo $result[0]['login_user'] ?>" required>
                        </div>

                        <div class="profilInputContainer">
                            <label for="telephone">Téléphone :</label>
                            <input type="tel" id="telephone" name="telephone" value="<?php echo $result[0]['phone_user'] ?>" required>
                        </div>

                        <div class="profilModalFooter">
                            <input class="profilModalSubmit" type="submit" value="Sauvegarder">
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div id="userPhotoModal" class="profileModalContainer">
            <div class="profileModal">

                <div class="profilModalTitle">
                    <h1>Modifier la photo profile</h1>
                    <button id="userPhotoModalClose" class="profilModalClose">X</button>
                </div>

                <div class="profileModalFormContainer">
                    <form name="editUserInfo" class="profileModalForm" action="profile.php" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="action" value="editUserPhoto">

                        <div class="profilInputContainer">
                            <label for="profilePictureFile">Image de profile :</label>
                            <input type="file" id="profilePictureFile" name="profilePictureFile">
                        </div>

                        <div class="profilModalFooter">
                            <input class="profilModalSubmit" type="submit" value="Sauvegarder">
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div id="userJustifModal" class="profileModalContainer">
            <div class="profileModal">

                <div class="profilModalTitle">
                    <h1>Justificatif</h1>
                    <button id="userJustifModalClose" class="profilModalClose">X</button>
                </div>

                <div class="profileModalFormContainer">
                    <form name="editUserInfo" class="profileModalForm" action="profile.php" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="action" value="editUserJustif">
                        <input type="hidden" name="id_absence" id="id_absence">

                        <div class="profilInputContainer">
                            <label for="JustifPictureFile">Photo de votre justification :</label>
                            <input type="file" id="JustifPictureFile" name="JustifPictureFile">
                        </div>

                        <div class="profilModalFooter">
                            <input class="profilModalSubmit" type="submit" value="Sauvegarder">
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./src/profile.js"></script>

</body>

</html>