<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
if($_COOKIE['role'] == 2) {
    require_once("../db/db.php");

    $id_user = $_COOKIE['id_user'];
    $select_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='$id_user'");
    $select_user = mysqli_fetch_assoc($select_user);
    $email = $select_user['email'];

    $currentDate = date('Y-m-d');
    $twoDaysLater = date('Y-m-d', strtotime($currentDate . '+2 days'));
    $id_user = $_COOKIE['id_user'];
    $select_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `due_date` BETWEEN '$currentDate' AND '$twoDaysLater' AND `id_participant`='$id_user' AND `status`!='Выполнено'");
    $select_task = mysqli_fetch_all($select_task);

    if(!empty($select_task)) {
        foreach ($select_task as $task) {
            $to = $email;
            $subject = "Задача/проект: " . $task[2];
            $message = $task[2] . " должна быть сдана в течение 2 дней!";
            $headers = "From: info@ittech.ru";

            mail($to, $subject, $message, $headers);
        }
    }
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

?>