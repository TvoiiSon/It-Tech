<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

$id_task = $_GET['id'];
$id_owner = $_COOKIE['id_user'];
$select_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id` = '$id_task' AND `id_owner`='$id_owner'");
$select_task = mysqli_fetch_assoc($select_task);

$select_comments = mysqli_query($connect,"SELECT * FROM `comments` WHERE `id_task`='$id_task'");
$select_comments = mysqli_fetch_all($select_comments);

$id_categ = $select_task["category"];

$select_category = mysqli_query($connect,"SELECT * FROM `category` WHERE `id`='$id_categ'");
$select_category = mysqli_fetch_assoc($select_category);

$title = (empty($select_task)) ? "Страница задачи/проекта - Нет задачи" : "Страница задачи/проекта - " . $select_task['task_name'];
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CASTCASEDOTCOME | It-Tech</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles/style.css">
    </head>
    <body>
    <?php if($_COOKIE['role'] == 2) { ?>
        <div class="container-fluid">
            <div class="row wrapper">
                <div class="col-lg-3 wrapper-left">
                    <div class="sidebar">
                        <div class="sidebar-wrapper">
                            <div class="sw-logo">
                                <div class="swl-wrapper">
                                    <p>CASTCASEDOTCOME | It-Tech</p>
                                </div>
                            </div>
                            <div class="sw-link-list">
                                <ul>
                                    <li>
                                        <a href="./index.php">
                                            <span><i class="fa-solid fa-house"></i></span>
                                            <span>Главная</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./create_task.php">
                                            <span><i class="fa-solid fa-calendar-plus"></i></span>
                                            <span>Создать задачу/проект</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./all_tasks.php">
                                            <span><i class="fa-solid fa-briefcase"></i></span>
                                            <span>Задачи/проекты в работе</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./generate_report.php">
                                            <span><i class="fa-solid fa-briefcase"></i></span>
                                            <span>Сформировать отчет о работе</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./logout.php">
                                            <span><i class="fa-solid fa-door-open"></i></span>
                                            <span>Выйти</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="main-content">
                        <div class="main-content-wrapper">
                            <div class="mnw-header">
                                <div class="mnw-header-wrapper">
                                    <span>Задача/Проект - <?= $title ?></span>
                                </div>
                            </div>
                            <hr>
                            <div class="mnw-body">
                                <h1>Информация о Задаче/Проекте</h1>
                                <div class="mnw-task">
                                    <div class="mnwt-wrapper">
                                        <p>Название задачи/проекта: <strong><?= $select_task['task_name'] ?></strong></p>
                                        <p>Описание задачи/проекта: <?= $select_task['task_description'] ?></p>
                                        <p>Категория задачи/проекта: <strong><?= $select_category['category_name'] ?></strong></p>
                                        <?php if (($select_task['start_date'] != "0000-00-00") && ($select_task['due_date'] != "0000-00-00")) { ?>
                                            <p>Дата начала задачи: <strong><?= $select_task['start_date'] ?></strong></p>
                                            <p>Дата сдачи задачи: <strong><?= $select_task['due_date'] ?></strong></p>
                                        <?php } elseif ($select_task['start_date'] != "0000-00-00") { ?>
                                            <p>Дата сдачи задачи: <strong><?= $select_task['start_date'] ?></strong></p>
                                        <?php } else { ?>
                                            <p>Дата начала или сдачи задачи/проекта не указана</p>
                                        <?php } ?>
                                        <p>Приоритет задачи: <strong><?= $select_task['priority'] ?></strong></p>
                                        <?php $id_participant_array = $select_task['id_participant'] ? explode(", ", $select_task['id_participant']) : array(); 
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
                                    </div>
                                </div>
                                
                                <?php if($select_task['status'] != 'Выполнено') { ?>
                                    <div class="mnw-link-participant">
                                        <div class="mnwlp-wrapper">
                                            <h1>Привязать участника для выполнения задачи/проекта</h1>
                                            <form id="link_participant" method="post">
                                                <input type="hidden" name="id_task" value="<?= $select_task['id'] ?>">
                                                <div class="text-field text-field_floating-2">
                                                    <input class="text-field__input" type="text" id="login" name="login" placeholder="Логин участника" required>
                                                    <label class="text-field__label" for="login">Логин участника</label>
                                                </div>
                                                <input type="submit" value="Создать" class="ctf-button">
                                            </form>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="mnw-link-participant">
                                        <div class="mnwlp-wrapper">
                                            <h1>Данная задача выполнена</h1>
                                            <?php if($select_task['comment'] != NULL) { ?>
                                                <h2>Комментарий к задаче/проекту</h2>
                                                <p><?= $select_task['comment'] ?></p>
                                                <?php if(!empty($select_comments)) { ?>
                                                    <br>
                                                    <h2>Комментарии пользователей</h2>
                                                    <?php foreach($select_comments as $comment) {
                                                        $id_sender = $comment[2];
                                                        $select_sender = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id_sender'");
                                                        $select_sender = mysqli_fetch_assoc($select_sender); ?>
                                                        <ul>
                                                            <li>Автор: <?= $select_sender['login'] ?></li>
                                                            <?php if($comment[3] != '') { ?>
                                                                <li>Текст: <?= $comment[3] ?></li>
                                                            <?php } ?>
                                                            <?php if($comment[4] != '') { ?>
                                                                <li><a href="http://localhost/hackathon/<?= $comment[4] ?>">Открыть картинку</a></li>
                                                            <?php } ?>
                                                        </ul>
                                                        <hr>
                                                    <?php } ?>
                                                <?php }?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <h2>Даная страница не доступна для администратора</h2>
    <?php } ?>
        <script src="./scripts/main.js"></script>
        <script src="https://kit.fontawesome.com/61b86703fe.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>