<?php
include_once "UserModel.php";

if (!isset($_SESSION['id'])) {
    session_start();
    $db = dbConnect();
    if (!isset($_SESSION['id'])) {
        header("location: login.php");
        exit();
    }

    $result = getUserInfo($_SESSION['id']);
    include('./View/navbarView.php');
}

?>

<body>
    <link rel="stylesheet" href="./src/style.css">
    <div class="userWrapper">
        <section class="users">
            <header>
                <div class="content">
                    <?php
                    $query = "SELECT * FROM users WHERE id_user = :unique_id";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':unique_id', $_SESSION['id'], PDO::PARAM_STR);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <div class="details">
                        <h1>Chats</h1>
                    </div>
                </div>
            </header>
            <div class="search">
                <input type="text" placeholder="Rechercher un utilisateur" aria-label="Rechercher un utilisateur">
                <button><i class="fas fa-search"> <img class="userSearchLogo" src="./svg/search.svg" alt=""></i></button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>

    <?php
    if (!isset($_GET['user_id'])) {
        include('./Modele/noMessage.php');
    }
    ?>

    <script src="src/user.js"></script>

</body>

</html>