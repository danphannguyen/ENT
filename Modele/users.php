<?php
require_once "session.php";
$outgoing_id = $_SESSION['id'];
require_once "../UserModel.php";
$db = dbConnect();

$sql = "SELECT * FROM users WHERE NOT id_user = :outgoing_id ORDER BY id_user DESC";
$stmt = $db->prepare($sql);
$stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
$stmt->execute();

$output = "";

if ($stmt->rowCount() == 0) {
    $output .= "Aucune discussion";
} elseif ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = :row_unique_id OR outgoing_msg_id = :row_unique_id)
                AND (outgoing_msg_id = :outgoing_id OR incoming_msg_id = :outgoing_id) ORDER BY msg_id DESC LIMIT 1";
        $stmt2 = $db->prepare($sql2);
        $stmt2->bindParam(':row_unique_id', $row['id_user'], PDO::PARAM_INT);
        $stmt2->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
        $stmt2->execute();
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    
        ($stmt2->rowCount() > 0) ? $result = $row2['msg'] : $result = " ";
        (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;
        if (isset($row2['outgoing_msg_id'])) {
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Toi: " : $you = "";
        } else {
            $you = "";
        }
        ($row['status'] == "Hors ligne") ? $offline = "style='background-color: #FF8F8F;'" : $offline = "style='background-color: #9ADE7B;";
        ($outgoing_id == $row['id_user']) ? $hid_me = "hide" : $hid_me = "";

        // if ($you == "Toi: " && ) {
        //     $notif = "";
        // } else {
        //     $notif = "<span class='notificationUser'>1</span>";
        // }
    
        $output .= '
                    <a class="userTemplateContainer" href="chat.php?user_id=' . $row['id_user'] . '">
                        <div class="userContent">

                            <div class="userContentLeft">
                                <img src="' . $row['photo_user'] . '" alt="">
                                <div class="details">
                                    <span class="userName">' . $row['prenom_user'] . " " . $row['nom_user'] . '</span>
                                    <div class="userInfoContainer">
                                        <span class="userStatus" ' . $offline . '></span>
                                        <p class="lastMsg">' . $you . $msg . '</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                ';
    }
}

echo $output;

?>
