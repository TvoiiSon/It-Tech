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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Страница задачи/проекта - <?= $select_task['task_name'] ?></title>
</head>
<body>
    <a href="./index.php">На главную</a>
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
    <p>Приоритет задачи: <strong><?= $select_task['priority'] ?></strong></p>
    <?php 
    $id_participant_array = $select_task['id_participant'] ? explode(", ", $select_task['id_participant']) : array(); 
    if (count($id_participant_array) == 0) { ?>
        <p><strong>Участников нет</strong></p>
    <?php } else if (count($id_participant_array) == 1) {
        $select_participant = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='$id_participant_array[0]'");
        $select_participant = mysqli_fetch_assoc($select_participant);
    ?>
        <p>Участник: <strong><?= $select_participant['login'] ?></strong></p>
    <?php } else { ?>
        <p>Участники: 
        <?php 
            $participant_names = array();
            foreach ($id_participant_array as $id) {
                $select_participant = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='$id'");
                $select_participant = mysqli_fetch_assoc($select_participant);
                $participant_names[] = $select_participant['login'];
            }
            echo "<strong>" . implode(", ", $participant_names) . "</strong>";
        ?>
        </p>
    <?php } ?>
    
    <p>Статус: <strong><?= $select_task['status'] ?></strong></p>

    <?php if($select_task["comment"] != NULL) {?>
        <p>Комментарий: <?= $select_task["comment"]; ?></p>
    <?php } ?>
    <br><br>
    <p>Привязать участника для выполнения задачи/проекта</p>
    <form id="link_participant" method="post">
        <input type="hidden" name="id_task" value="<?= $select_task['id'] ?>">
        <input type="text" name="login" placeholder="Логин участника" required>
        <input type="submit" value="Привязать">
    </form>

    <script src="./scripts/main.js"></script>
</body>
</html>