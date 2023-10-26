<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
} 
if($_COOKIE['role'] == 2) {
    require_once("../db/db.php");

    $id_task = $_POST['id_task'];
    $task_comment = empty($_POST['task_comment']) ? 'Пусто' : $_POST['task_comment'];

    mysqli_query($connect, "UPDATE `tasks` SET `status`='Выполнено', `comment`='$task_comment' WHERE `id` = '$id_task'");
    if (mysqli_affected_rows($connect) > 0) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>