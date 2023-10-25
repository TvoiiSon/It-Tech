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
    <title>Работа над задачей/проектом - <?= $select_task['task_name'] ?></title>
</head>
<body>
    <a href="./index.php">На главную</a>
    <h2>Работа над задачей/проектом - <?= $select_task['task_name'] ?></h2>
    <p>Название задачи/проекта - <strong><?= $select_task['task_name'] ?></strong></p>
    <p>Описание задачи/проекта: <?= $select_task['task_description'] ?></p>
    <?php 
    if (($select_task['start_date'] != "0000-00-00") && ($select_task['due_date'] != "0000-00-00")) { ?>
        <p>Дата начала задачи: <strong><?= $select_task['start_date'] ?></strong></p>
        <p>Дата начала задачи: <strong><?= $select_task['due_date'] ?></strong></p>
    <?php } elseif ($select_task['start_date'] != "0000-00-00") { ?>
        <p>Дата сдачи задачи: <strong><?= $select_task['start_date'] ?></strong></p>
    <?php } else { ?>
        <p>Дата начала или сдачи задачи/проекта не указана</p>
    <?php } ?>

    <p>Приоритет задачи: <?= $select_task['priority'] ?></p>
    <p>Статус: <strong><?= $select_task['status'] ?></strong></p>
    <?php 
        if($select_task['status'] == 'Только создано') {
            $text_link = "Начать выполнение";
            $status = "В процессе";
        } else if($select_task["status"] == 'В процессе') {
            $text_link = "Закончить";
            $status = "Выполнено";
        } else if($select_task["status"] == 'Отложено') {
            $text_link = "Начать выполнение";
            $status = "В процессе";
        } else {
            $text_link = "";
            $status = "";
        }
    ?>

    <?php if($select_task["status"] != "В процессе") { ?>
        <a href="./vendor/vendor_change_status_task.php?id=<?= $id_task ?>&status=<?= $status ?>"><?= $text_link ?></a><br>
    <?php } else { ?>
        <form action="./vendor/vendor_complete_task.php" method="post">
            <input type="hidden" name="id_task" value="<?= $id_task ?>">
            <textarea name="task_comment" cols="30" rows="10" placeholder="Комментарий к задаче"></textarea>
            <input type="submit" value="Закончить">
        </form>
    <?php } ?>
    <?php if($select_task["status"] != "Отложено") { ?>
        <a href="./vendor/vendor_change_status_task.php?id=<?= $id_task ?>&status=Отложено">Отложить</a>
    <?php } ?>
</body>
</html>