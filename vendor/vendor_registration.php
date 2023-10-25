<?php
session_start();
require_once("../db/db.php");

$role = 2;
$id_group = 0;
$login = $_POST["login"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$email = $_POST["email"];

$select_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
$select_user = mysqli_fetch_assoc($select_user);

if(empty($select_user)) {
    if($password != $confirm_password) {
        $_SESSION['errRegistration'] = "Пароли не совпадают!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($connect, "INSERT INTO `users`
                            (`role`, `id_group`, `login`, `password`, `email`)
                            VALUES 
                            ('$role', '$id_group', '$login', '$pass_hash', '$email')
        ");
        header("Location: ../index.php");
    }
} else {
    $_SESSION['errRegistration'] = "Такой пользователь уже существует!";
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

?>