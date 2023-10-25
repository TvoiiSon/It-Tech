<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$id_owner = $_COOKIE["id_user"];
$task_name = $_POST["task_name"];
$task_description = $_POST["task_description"];
$due_date = $_POST["due_date"];
$priority = $_POST["priority"];

$select_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `task_name` = '$task_name'");
$select_task = mysqli_fetch_assoc($select_task);

if(empty($select_task)) {
    mysqli_query($connect, "INSERT INTO `tasks`
                        (`id_owner`, `task_name`, `task_description`, `due_date`, `priority`)
                        VALUES 
                        ('$id_owner', '$task_name', '$task_description', '$due_date', '$priority')
    ");
    header("Location: ../index.php");
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>