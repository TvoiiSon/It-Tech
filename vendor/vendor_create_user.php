<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$role = 2;
$login = $_POST["login"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];
$email = $_POST["email"];

$select_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
$select_user = mysqli_fetch_assoc($select_user);

if(empty($select_user)) {
    if($password != $confirm_password) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($connect, "INSERT INTO `users`
                            (`role`, `login`, `password`, `email`)
                            VALUES 
                            ('$role', '$login', '$pass_hash', '$email')
        ");
        if (mysqli_affected_rows($connect) > 0) {
            echo "success";
        } else {
            echo "error";
        }
    }
} else {
    echo "error";
}

?>