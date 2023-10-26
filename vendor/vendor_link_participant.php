<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
if($_COOKIE['role'] == 2) {
    require_once("../db/db.php");

    $id_owner = $_COOKIE['id_user'];
    $id_task = $_POST['id_task'];
    $login = $_POST['login'];

    $select_user = mysqli_query($connect, "SELECT `id` FROM `users` WHERE `login` = '$login'");
    $select_user = mysqli_fetch_assoc($select_user);

    if(empty($select_user)) {
        echo "error";
    } else {
        $select_id_participant = mysqli_query($connect, "SELECT `id_participant` FROM `tasks` WHERE `id` = '$id_task'");
        $select_id_participant = mysqli_fetch_assoc($select_id_participant);
        
        if ($select_id_participant['id_participant'] !== NULL) {
            $newIdParticipant = $select_id_participant['id_participant'] . ', ' . $select_user['id'];
        } else {
            $newIdParticipant = $select_user['id'];
        }

        mysqli_query($connect, "UPDATE `tasks` SET `id_participant`='$newIdParticipant' WHERE `id` = '$id_task'");
        if (mysqli_affected_rows($connect) > 0) {
            echo "success";
        } else {
            echo "error";
        }
    }
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>