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
    <a href="./ade.php">
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