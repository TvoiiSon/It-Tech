<?php 
session_start();
$id = $_COOKIE['id_user'];
if(empty($id)) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание отчетов</title>
</head>
<body>
    <a href="./index.php">На главную</a>
    <h2>Создать отчет</h2>
    <form action="./vendor/vendor_generate_report.php" method="post">
        <label for="start_date">Начальное число</label>
        <input type="date" name="start_date"><br>
        <label for="due_date">Конечное число</label>
        <input type="date" name="due_date"><br>
        <input type="submit" value="Создать">
    </form>
</body>
</html>