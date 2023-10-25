<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$id_task = $_GET['id'];
$status = $_GET['status'];

mysqli_query($connect, "UPDATE `tasks` SET `status`='$status' WHERE `id` = '$id_task'");
header("Location: " . $_SERVER['HTTP_REFERER']);
?>