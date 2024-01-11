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
                <img src="./svg/accueil.svg" alt="Lien vers l'accueil">
            </div>
            <span>Accueil</span>
        </div>
    </a>
    <a href="./dashboard.php">
        <div class="navIconContainer">
            <div class="navIconBg">
                <img src="./svg/dashboard.svg" alt="Lien vers le dashboard">
            </div>
            <span>Dashboard</span>
        </div>
    </a>
    <a href="./ade.php">
        <div class="navIconContainer">
            <div class="navIconBg">
                <img src="./svg/calendirer.svg" alt="Lien vers le calendrier">
            </div>
            <span>Calendrier</span>
        </div>
    </a>
    <a href="./cours.php">
        <div class="navIconContainer">
            <div class="navIconBg">
                <img src="./svg/cours.svg" alt="Lien vers les cours">
            </div>
            <span>Cours</span>
        </div>
    </a>
    <a href="#">
        <div class="navIconContainer">
            <div class="navIconBg">
                <img src="./svg/chat.svg" alt="Liens vers le chat">
            </div>
            <span>Chat</span>
        </div>
    </a>
</div>

<div class="navBottom">
    <a href="./profile.php">
        <div class="navIconBg2">
            <img src="<?php echo $result[0]['photo_user']; ?>" alt="vers profile">
        </div>
    </a>
</div>

</nav>