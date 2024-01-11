<?php
if (!isset($_SESSION['id'])) {
    session_start();
}
if (isset($_SESSION['id'])) {
    include('./UserModel.php');
    $db = dbConnect();
    include('./rechercheUser.php');
    $result = getUserInfo($_SESSION['id']);
    include('./View/navbarView.php');
}
?>

<body>

    <div class="userSection">
        <section class="chat-area">
            <div class="chat-areaTop">
                <header class="userHeader">
                    <?php
                    $user_id = $_GET['user_id'];
                    $query = "SELECT * FROM users WHERE id_user = :user_id";
                    $stmt = $db->prepare($query);
                    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($stmt->rowCount() > 0) {
                        // $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    } else {
                        exit();
                    }
                    ?>
                    <img src="<?php echo $row['photo_user']; ?>" alt="">
                    <div class="details">
                        <span class="userName"><?php echo $row['prenom_user'] . " " . $row['nom_user'] ?></span>
                        <p class="userHeaderStatus"><?php echo $row['status']; ?></p>
                    </div>
                </header>
                <div class="chat-box">
                </div>
            </div>

            <form id="sendMessage" action="./Modele/insert-chat.php" method="POST" class="typing-area">
                <img src="./svg/emoji.svg" alt="">
                <img src="./svg/file.svg" alt="">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Ecrivez votre message..." autocomplete="off">
                <button id="sendMessageButton" type="submit" id="messageSend"><i class="fab fa-telegram-plane">
                    <img src="./svg/arrowUp.svg" alt="">
                </i></button>
            </form>
        </section>
    </div>

</body>
<script src="./src/chat.js"></script>

</html>