<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$login = $_POST['login'];
$password = $_POST['password'];

$select_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
$select_user = mysqli_fetch_assoc($select_user);

if(empty($select_user)) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    if(password_verify($password, $select_user['password'])) {
        setcookie("id_user", $select_user['id'], time()+28800, "/");
        setcookie("role", $select_user['role'], time()+28800, "/");
        header("Location: ../index.php");
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
?>