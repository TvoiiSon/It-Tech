<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$id_task = $_POST['id_task'];
$id_user = $_COOKIE['id_user'];
$comment_text = $_POST['comment_text'];

if (empty($_FILES)) {
    $path = '';
} else {
    $path = 'uploads/' . time() . $_FILES['pathimg']['name'];
    move_uploaded_file($_FILES['pathimg']['tmp_name'], '../' . $path);
}

mysqli_query($connect, "INSERT INTO `comments`
                        (`id_task`, `id_user`, `comment_text`, `file_path`)
                        VALUES
                        ('$id_task', '$id_user', '$comment_text', '$path')
");

if (mysqli_affected_rows($connect) > 0) {
    echo "success";
} else {
    echo "error";
}

?>