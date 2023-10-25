<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$id = $_POST["id"];
$login = $_POST['login'];
$email = $_POST['email'];

mysqli_query($connect, "UPDATE `users` SET `login`='$login', `email`='$email' WHERE `id` = '$id'");
header("Location: ../index.php");
?>