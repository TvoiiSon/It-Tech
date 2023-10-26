<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
if($_COOKIE['role'] == 1) {
    require_once("../db/db.php");

    $id = $_POST["id"];
    $login = $_POST['login'];
    $email = $_POST['email'];

    mysqli_query($connect, "UPDATE `users` SET `login`='$login', `email`='$email' WHERE `id` = '$id'");
    if (mysqli_affected_rows($connect) > 0) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>