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
$start_date = !empty($_POST["single_date_start"]) ? $_POST["single_date_start"] : (!empty($_POST["start_date"]) ? $_POST["start_date"] : NULL);
$due_date = !empty($due_date) ? $due_date : $start_date;
$category = $_POST["category"];
$priority = $_POST["priority"];

$select_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `task_name` = '$task_name'");
$select_task = mysqli_fetch_assoc($select_task);

if(empty($select_task)) {
    mysqli_query($connect, "INSERT INTO `tasks`
                        (`id_owner`, `task_name`, `task_description`, `start_date`, `due_date`, `category`, `priority`, `status`)
                        VALUES 
                        ('$id_owner', '$task_name', '$task_description', '$start_date', '$due_date', '$category', '$priority', 'Только создано')
    ");
    if (mysqli_affected_rows($connect) > 0) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>