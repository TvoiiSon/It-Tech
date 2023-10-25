<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

$id_task = $_GET['id'];
$select_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id` = '$id_task'");
$select_task = mysqli_fetch_assoc($select_task);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница задачи/проекта - <?= $select_task['task_name'] ?></title>
</head>
<body>
    <a href="./index.php">На главную</a>
    <p>Название задачи/проекта - <strong><?= $select_task['task_name'] ?></strong></p>
    <p>Описание задачи/проекта: <?= $select_task['task_description'] ?></p>
    <p>Дата сдачи задачи: <strong><?= $select_task['due_date'] ?></strong></p>
    <p>Приоритет задачи: <?= $select_task['priority'] ?></p>
    <p>Участники</p>
    <?php 
    $id_participant_array = $select_task['id_participant'] ? explode(", ", $select_task['id_participant']) : array(); 
    if (count($id_participant_array) == 0) { ?>
        <p><strong>Участников нет</strong></p>
    <?php } ?>
    <ul>
        <?php foreach ($id_participant_array as $id) { 
            $select_participant = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='$id'");
            $select_participant = mysqli_fetch_assoc($select_participant); ?>
            <li>Участник: <?= $select_participant['login'] ?></li>
        <?php } ?>
    </ul>
    <p>Статус: <strong><?= $select_task['status'] ?></strong></p>
    <p>Привязать участника задачи/проекта</p>
    <form action="./vendor/vendor_link_participant.php" method="post">
        <input type="hidden" name="id_task" value="<?= $select_task['id'] ?>">
        <input type="text" name="login" placeholder="Логин участника" required>
        <input type="submit" value="Отправить заявку на привязку">
    </form>
</body>
</html>