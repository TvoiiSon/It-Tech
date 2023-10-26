<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
if($_COOKIE['role'] == 2) {
    require_once("../db/db.php");

    $currentDate = date('Y-m-d');
    $twoDaysLater = date('Y-m-d', strtotime($currentDate . '+2 days'));
    $id_user = $_COOKIE['id_user'];
    $select_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `due_date` BETWEEN '$currentDate' AND '$twoDaysLater' AND `id_participant`='$id_user' AND `status`!='Выполнено'");
    $data = array();
    while ($row = mysqli_fetch_assoc($select_task)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>