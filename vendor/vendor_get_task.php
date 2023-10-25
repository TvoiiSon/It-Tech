<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$currentDate = date('Y-m-d');
$twoDaysLater = date('Y-m-d', strtotime($currentDate . '+2 days'));
$select_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `due_date` BETWEEN '$currentDate' AND '$twoDaysLater'");
$data = array();
while ($row = mysqli_fetch_assoc($select_task)) {
    $data[] = $row;
}
echo json_encode($data);
?>