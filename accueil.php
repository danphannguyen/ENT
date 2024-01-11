<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/style.css">
    <link rel="icon" href="./svg/symbLogo.svg">
    <title>ENT | Home</title>
</head>

<body>

    <?php
    session_start();

    if (isset($_SESSION['id'])) {
        include('./UserModel.php');

        $result = getUserInfo($_SESSION['id']);

        $matieres = getMatieres($result[0]['ext_promotions']);

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

    include('./View/navbarView.php');

    ?>

    <section id="accueilSection">

        <div id="accueilBodyContainer">

            <div id="accueilHeader">
                <div id="accueilHeaderLeft">
                    <h1>
                        <span>Bienvenue,</span>
                        <br>
                        <span><?php echo $result[0]['prenom_user'] ?></span>
                    </h1>
                </div>

                <div id="accueilHeaderRight">
                    <span>Vous avez 2 devoirs à rendre cette semaine</span>
                    <img src="./img/progressBar.png" alt="">
                </div>
            </div>

            <div id="accueilCours">
                <div id="accueilCoursHeader">
                    <div class="accueilBodyLabel"><span><h2>Enseignements</h2></span></div>
                    <form action="" id="accueilCoursSearchbar">
                        <input aria-label="barre de recherche" type="text">
                        <div id="searchCoursLogo"><img src="./svg/search.svg" alt=""></div>
                    </form>
                    <form action="">
                        <select name="" id="accueilCoursSelect" aria-label="Sélectionner la compétence">
                            <option disabled selected value="">Compétences</option>
                            <option value="">Développer</option>
                            <option value="">Entreprendre</option>
                            <option value="">Comprendre</option>
                            <option value="">Exprimer</option>
                        </select>
                    </form>
                </div>

                <div id="accueilCoursWrapper">

                    <?php
                    foreach ($matieres as $matiere) {
                        echo '<div class="coursTemplateContainer">';
                        echo '<div class="coursContentBg">';
                        echo '<span>' . $matiere['nom_matiere'] . '</span>';
                        echo '<img src="./svg/star.svg" alt="">';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                </div>
            </div>

            <div class="ade">
                <table class="fixed_headers">
                    <thead>
                        <tr>
                            <th class="tab-month">janvier</th>
                            <th>L <br><span>22</span></th>
                            <th>M <br><span>23</span></th>
                            <th>M <br><span>24</span></th>
                            <th>J <br><span>25</span></th>
                            <th>V <br><span>26</span></th>
                            <th>S <br><span>27</span></th>
                            <th>D <br><span>28</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>08:00</td>
                        </tr>
                        <tr>
                            <td>09:00</td>
                            <td class="green" rowspan="4">Autonomie
                                SAE 3 -
                                ABCD <br>
                                <span>IUC 121 <br>
                                    IUC 126</span>
                            </td>
                            <td class="green" rowspan="4">Autonomie
                                SAE 3 -
                                ABCD <br>
                                <span>IUC 121 <br>
                                    IUC 126</span>
                            </td>
                            <td class="rose" rowspan="2">SAE 3.02.A
                                Anglais <br>
                                Web - AB
                                IUC 126
                            </td>
                            <td class="orange" rowspan="2">R 3.13
                                Dévpt <br>
                                Back - AB
                                IUC 120
                            </td>
                            <td class="lilas" rowspan="2">SAE 3.02.A
                                Produire des
                                contenus - AB
                                IUC 026
                            </td>
                        </tr>
                        <tr>
                            <td>10:00</td>
                        </tr>
                        <tr>
                            <td>11:00</td>
                            <td class="mauve" rowspan="2">SAE 3.02.A
                                Anglais <br>
                                Web - AB
                                IUC 126
                            </td>
                            <td class="fluo" rowspan="2">SAE 3.02.A
                                Anglais <br>
                                Web - AB
                                IUC 126
                            </td>
                            <td class="turquoise" rowspan="2">R 3.16
                                Gestion de
                                Projet - AB
                                IUC 157
                            </td>
                        </tr>
                        <tr>
                            <td>12:00</td>
                        </tr>
                        <tr>
                            <td>13:00</td>
                        </tr>
                        <tr>
                            <td>14:00</td>
                            <td class="turquoise" rowspan="2">R 3.16
                                Gestion de
                                Projet - AB
                                IUC 157
                            </td>
                            <td class="green" rowspan="4">
                                Autonomie
                                SAE 3 -
                                ABCD <br>
                                <span>IUC 121 <br>
                                    IUC 126</span>
                            </td>
                            <td class="rose" rowspan="2">SAE 3.02.A
                                Anglais <br>
                                Web - AB
                                IUC 126
                            </td>
                            <td class="orange-clair" rowspan="2">R 3.16
                                Gestion de
                                Projet - AB
                                IUC 157
                            </td>
                            <td class="rose" rowspan="2">SAE 3.02.A
                                Anglais <br>
                                Web - AB
                                IUC 126
                            </td>
                        </tr>
                        <tr>
                            <td>15:00</td>
                        </tr>
                        <tr>
                            <td>16:00</td>
                            <td class="ciel" rowspan="2">R 3.13
                                Dévpt <br>
                                Back - AB
                                IUC 120
                            </td>
                            <td class="lilas" rowspan="2">SAE 3.02.A
                                Anglais <br>
                                Web - AB
                                IUC 126
                            </td>
                            <td class="violet" rowspan="2">SAE 3.02.A
                                Anglais <br>
                                Web - AB
                                IUC 126
                            </td>
                            <td class="ciel" rowspan="2">R 3.13
                                Dévpt <br>
                                Back - AB
                                IUC 120
                            </td>
                        </tr>
                        <tr>
                            <td>17:00</td>
                        </tr>
                        <tr class="noborder">
                            <td>18:00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="accueilNote">
                <div class="accueilBodyLabel"><span>Dernières Notes</span></div>
                <div class="noteWrapper">
                    <div class="div1">Cours</div>
                    <div class="div2">Activité</div>
                    <div class="div3">Note</div>
                    <div class="div4">Date</div>

                    <div class="div5">
                        <div class="hr"></div>
                    </div>

                    <div class="div6">Représentation et trait ...</div>
                    <div class="div7">Contrôle 2</div>
                    <div class="div8"><span class="accueilNoteSpan">13,5/20</span></div>
                    <div class="div9">23 novembre</div>

                    <div class="div10">PPP</div>
                    <div class="div11">Rapport de stage</div>
                    <div class="div12"><span class="accueilNoteSpan">14/20</span></div>
                    <div class="div13">21 novembre</div>

                    <div class="div14">Représentation et trait ...</div>
                    <div class="div15">Contrôle 1</div>
                    <div class="div16"><span class="accueilNoteSpan">2/10</span></div>
                    <div class="div17">3 octobre</div>

                    <div class="div18">Développement web</div>
                    <div class="div19">Interro</div>
                    <div class="div20"><span class="accueilNoteSpan">10/20</span></div>
                    <div class="div21">26 septembre</div>
                </div>

                <div id="accueilNoteFooter">
                    <a href="./notes.php" id="accueilNoteButton" aria-label="Mes notes">
                        <span>Voir plus</span>
                    </a>
                </div>
            </div>

            <div id="accueilActualite">
                <div id="accueilActualiteHeader"><h2>Actualités</h2></div>
                <div id="accueilActualiteWrapper">

                    <div class="div1 actualiteTemplate">
                        <div class="actualiteHeader">
                            <img src="./svg/news.svg" alt="">
                            <div>
                                <span>Figma c’est trop dur</span>
                                <span>08/12/23 : 10h25</span>
                            </div>
                        </div>
                        <div class="actualiteBody">
                            <p>Lorem ipsum dolor sit amet, salut sal consectetur adipiscing elit. Duis sed tempus metus, a tincidunt urna. Cras quam purus, hendrerit attali ante quis, porttitor pulvinar veli glimp </p>
                        </div>
                        <div class="actualiteFooter">
                            <a href="" aria-label="Les évènements de l'iut">
                                <span>Découvrir plus</span>
                            </a>
                        </div>
                    </div>

                    <div class="div2">
                        <div class="hr-v"></div>
                    </div>

                    <div class="div3 actualiteTemplate">
                        <div class="actualiteHeader">
                            <img src="./svg/news.svg" alt="">
                            <div>
                                <span>Figma c’est trop dur</span>
                                <span>08/12/23 : 10h25</span>
                            </div>
                        </div>
                        <div class="actualiteBody">
                            <p>Lorem ipsum dolor sit amet, salut sal consectetur adipiscing elit. Duis sed tempus metus, a tincidunt urna. Cras quam purus, hendrerit attali ante quis, porttitor pulvinar veli glimp </p>
                        </div>
                        <div class="actualiteFooter">
                            <a href="" aria-label="Les sports a l'IUT">
                                <span>Découvrir plus</span>
                            </a>
                        </div>
                    </div>

                    <div class="div4">
                        <div class="hr-v"></div>
                    </div>

                    <div class="div5 actualiteTemplate">
                        <div class="actualiteHeader">
                            <img src="./svg/news.svg" alt="">
                            <div>
                                <span>Figma c’est trop dur</span>
                                <span>08/12/23 : 10h25</span>
                            </div>
                        </div>
                        <div class="actualiteBody">
                            <p>Lorem ipsum dolor sit amet, salut sal consectetur adipiscing elit. Duis sed tempus metus, a tincidunt urna. Cras quam purus, hendrerit attali ante quis, porttitor pulvinar veli glimp </p>
                        </div>
                        <div class="actualiteFooter">
                            <a href="" aria-label="La cantine">
                                <span>Découvrir plus</span>
                            </a>
                        </div>
                    </div>

                    <div class="div6">
                        <div class="hr-v"></div>
                    </div>

                    <div class="div7 actualiteTemplate">
                        <div class="actualiteHeader">
                            <img src="./svg/news.svg" alt="">
                            <div>
                                <span>Figma c’est trop dur</span>
                                <span>08/12/23 : 10h25</span>
                            </div>
                        </div>
                        <div class="actualiteBody">
                            <p>Lorem ipsum dolor sit amet, salut sal consectetur adipiscing elit. Duis sed tempus metus, a tincidunt urna. Cras quam purus, hendrerit attali ante quis, porttitor pulvinar veli glimp </p>
                        </div>
                        <div class="actualiteFooter">
                            <a href="" aria-label="La vie de l'IUT">
                                <span>Découvrir plus</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div id="accueilAsideContainer">

            <a id="accueilWidgetOneLink" href="./ade.php">
                <div id="accueilAsideWidgetOne">
                    <div><span>SAE 3.02.A - Anglais Web (AL)</span></div>
                    <div><span>8h15 - 10h15</span></div>
                    <div>
                        <span>TP B</span>
                        <span>
                            <img src="./svg/ping.svg" alt="Lieu du cours :">
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

                <a href="./crous.php" aria-label="Vers le crous">
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