<?php 
session_start();
$id = $_COOKIE['id_user'];
if(empty($id)) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Создание отчетов</title>
</head>
<body>
    <a href="./index.php">На главную</a>
    <h2>Создать отчет</h2>
    <form action="./vendor/vendor_generate_report.php" method="post" class="generate_report_form">
        <div>
            <label for="start_date">Начальное число</label>
            <input type="date" name="start_date" id="start_date">
        </div>
        <div>
            <label for="due_date">Конечное число</label>
            <input type="date" name="due_date" id="due_date">
        </div>
        
        <input type="submit" value="Создать">
    </form>
</body>
</html>