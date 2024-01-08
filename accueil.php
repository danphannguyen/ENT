<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <title>Document</title>
</head>

<body>

    <?php
    session_start();

    if (isset($_SESSION['id'])) {
        include('./UserModel.php');

        $result = getUserInfo($_SESSION['id']);
    } else {
        header('Location: login.php');
    }

    $abs = getUserAbs($_SESSION['id']);

    // On Créer un tableau pour récupèrer les durées d'absence groupées par justification
    $dureesGroupedByJustification = array(
        '0' => 0, // Durées pour isjustifie = 0
        '1' => 0, // Durées pour isjustifie = 1
        '2' => 0  // Durées pour isjustifie = 2
    );
    foreach ($abs as $ab) {

        // ==== Calcul des durées d'absence groupées par justification ====
        // Convertir la durée d'absence en secondes
        $dureeEnSecondes = strtotime($ab['duree_absence']) - strtotime('00:00:00');

        // Ajouter la durée au total correspondant à l'état de justification
        $dureesGroupedByJustification[$ab['isjustifie']] += $dureeEnSecondes;
    }

    $absNJ = date("H:i", $dureesGroupedByJustification[1]);

    $absNJ = explode(':', $absNJ);

    ?>

    <nav>

        <div class="navTop">
            <div class="navUnivLogo">
                <img id="navIconLogo" src="./svg/SymbLogo.svg" alt="">
            </div>
        </div>

        <div id="navMiddle">
            <a href="./accueil.php">
                <div class="navIconContainer">
                    <div class="navIconBg">
                        <img src="./svg/accueil.svg" alt="">
                    </div>
                    <span>Accueil</span>
                </div>
            </a>
            <a href="#">
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
            <a href="./profile.php">
                <div class="navIconBg2">
                    <img src="<?php echo $result[0]['photo_user']; ?>" alt="">
                </div>
            </a>
        </div>

    </nav>

    <section id="accueilSection">

        <div id="accueilBodyContainer">
            
        </div>

        <div id="accueilAsideContainer">

            <a id="accueilWidgetOneLink" href="./ade.php">
                <div id="accueilAsideWidgetOne">
                    <div><span>SAE 3.02.A - Anglais Web (AL)</span></div>
                    <div><span>8h15 - 10h15</span></div>
                    <div>
                        <span>TP B</span>
                        <span>
                            <img src="./svg/ping.svg" alt="">
                            IUC 126
                        </span>
                    </div>
                </div>
            </a>

            <div id="accueilAsideDouble">

                <a href="./profile.php">
                    <div id="accueilAsideWidgetTwo">
                        <span class="accueilWidgetTwoSpan" style="color: #FF5A5A;">Absences</span>
                        <div>
                            <span id="absFirstPart"><?php echo $absNJ[0] ?>h</span><span><?php echo $absNJ[1] ?></span>
                        </div>
                        <span class="accueilWidgetTwoSpan" style="text-align: end;">à justifier</span>
                    </div>
                </a>

                <a href="./crous.php">
                    <div id="accueilAsideWidgetThree"></div>
                </a>

            </div>

            <div id="accueilAsideWidgetFour">
                <span>Notification</span>

                <div id="notifHr" class="hr"></div>

                <div id="notifTemplateWrapper">
                    <div class="notifTemplate">
                        <img src="./svg/calendirer.svg" alt="">
                        <div class="notifContent">
                            <span>Changement ADE</span>
                            <span>10h30</span>
                        </div>
                    </div>
                    <div class="notifTemplate">
                        <img src="./svg/calendirer.svg" alt="">
                        <div class="notifContent">
                            <span>Changement ADE</span>
                            <span>10h30</span>
                        </div>
                    </div>
                    <div class="notifTemplate">
                        <img src="./svg/calendirer.svg" alt="">
                        <div class="notifContent">
                            <span>Changement ADE</span>
                            <span>10h30</span>
                        </div>
                    </div>
                    <div class="notifTemplate">
                        <img src="./svg/calendirer.svg" alt="">
                        <div class="notifContent">
                            <span>Changement ADE</span>
                            <span>10h30</span>
                        </div>
                    </div>
                    <div class="notifTemplate">
                        <img src="./svg/calendirer.svg" alt="">
                        <div class="notifContent">
                            <span>Changement ADE</span>
                            <span>10h30</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>

</body>

</html>