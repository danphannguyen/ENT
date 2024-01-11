<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once "../UserModel.php";
    $db = dbConnect();
    $outgoing_id = $_SESSION['id'];
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];
    var_dump($message);
    if (!empty($message)) {
            $query = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES (:incoming_id, :outgoing_id, :message)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':incoming_id', $incoming_id, PDO::PARAM_INT);
            $stmt->bindParam(':outgoing_id', $outgoing_id, PDO::PARAM_INT);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            $stmt->execute();
    }
} else {
    //header("location: ../login.php");

}
?>