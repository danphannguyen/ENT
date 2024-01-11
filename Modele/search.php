<?php
session_start();
include_once "../UserModel.php";
$db = dbConnect();

$outgoing_id = $_SESSION['id'];
$searchTerm = filter_input(INPUT_POST, 'searchTerm', 513);

// Utilisation de PDO
$sql = "SELECT * FROM users WHERE NOT id_user = :outgoing_id AND (prenom_user LIKE :searchTerm OR nom_user LIKE :searchTerm)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_STR);
$stmt->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
$stmt->execute();

$output = "";

if ($stmt->rowCount() > 0) {
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
        ($row['status'] == "Déconnecter") ? $offline = "Déconnecter" : $offline = "";
        ($outgoing_id == $row['id_user']) ? $hid_me = "hide" : $hid_me = "";
    
        $output .= '<a href="chat.php?user_id=' . $row['id_user'] . '">
                        <div class="content">
                        <img src="php/images/' . $row['photo_user'] . '" alt="">
                        <div class="details">
                            <span>' . $row['prenom_user'] . " " . $row['nom_user'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                        </div>
                    </a>';
    }
echo $output;
} else {
    $output .= 'Aucun utilisateur trouvé correspondant à votre recherche';
}

echo $output;
?>