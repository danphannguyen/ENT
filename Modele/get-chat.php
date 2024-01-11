<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once "../UserModel.php";
    $db = dbConnect();
    $outgoing_id = $_SESSION['id'];
    $incoming_id = $_POST['incoming_id'];
    $output = "";
    
    $query = $db->prepare("SELECT * FROM messages LEFT JOIN users ON users.id_user = messages.outgoing_msg_id
                            WHERE (outgoing_msg_id = :outgoing_id AND incoming_msg_id = :incoming_id)
                            OR (outgoing_msg_id = :incoming_id AND incoming_msg_id = :outgoing_id) ORDER BY msg_id");
    $query->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
    $query->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() > 0) {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            if ($row['outgoing_msg_id'] === intval($outgoing_id)) {
                $message = ($row['msg'] !== null) ? htmlspecialchars($row['msg'], ENT_QUOTES, 'UTF-8') : '';
                $output .= '<div class="chat outgoing">
                            <div class="details message">
                                <p>' . $message . '</p>
                            </div>
                            </div>';
            } else {
                $photo_user = ($row['photo_user'] !== null) ? htmlspecialchars($row['photo_user'], ENT_QUOTES, 'UTF-8') : '';
                $message = ($row['msg'] !== null) ? htmlspecialchars($row['msg'], ENT_QUOTES, 'UTF-8') : '';
                $output .= '<div class="chat incoming">
                            <div class="details message">
                                <p>' . $message . '</p>
                            </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">Aucun message n\'a encore été envoyé.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
?>
