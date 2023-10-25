<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$id_task = $_POST['id_task'];
$task_comment = $_POST['task_comment'];

mysqli_query($connect, "UPDATE `tasks` SET `status`='Выполнено', `comment`='$task_comment' WHERE `id` = '$id_task'");
header("Location: ../index.php");
?>