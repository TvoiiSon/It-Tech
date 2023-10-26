<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

$id_task = $_GET['id'];
$id = $_COOKIE['id_user'];
$select_task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id` = '$id_task'");
$select_task = mysqli_fetch_assoc($select_task);

$select_comments = mysqli_query($connect, "SELECT * FROM `comments` WHERE `id_task` = '$id_task'");
$select_comments = mysqli_fetch_all($select_comments);

$select_working_tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE FIND_IN_SET('$id', REPLACE(`id_participant`, ' ', '')) AND `id`='$id_task' AND `status`!='Выполнено' ORDER BY `priority` DESC");
$select_working_tasks = mysqli_fetch_assoc($select_working_tasks);

$title = (empty($select_working_tasks)) ? "Работа над задачей/проектом - Нет задачи" : "Работа над задачей/проектом - " . $select_working_tasks['task_name'];
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
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
                                    <span><?= $title ?></span>
                                </div>
                            </div>
                            <hr>
                            <div class="mnw-body">
                                <h1>Информация о Задаче/Проекте</h1>
                                <?php if($select_working_tasks != NULL) { ?>
                                    <?php if($select_task['status'] != "Выполнено") { ?>
                                        <div class="mnw-task">
                                            <div class="mnwt-wrapper">
                                                <p>Название задачи/проекта: <strong><?= $select_task['task_name'] ?></strong></p>
                                                <p>Описание задачи/проекта: <?= $select_task['task_description'] ?></p>
                                                <?php 
                                                if (($select_task['start_date'] != "0000-00-00") && ($select_task['due_date'] != "0000-00-00")) { ?>
                                                    <p>Дата начала задачи: <strong><?= $select_task['start_date'] ?></strong></p>
                                                    <p>Дата сдачи задачи: <strong><?= $select_task['due_date'] ?></strong></p>
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
                                                    <div class="mnwt-finish-task">
                                                        <div class="mnwtft-wrapper">
                                                            <form method="post" id="complete_task">
                                                                <input type="hidden" name="id_task" value="<?= $id_task ?>">
                                                                <div class="text-field text-field_floating-2">
                                                                    <textarea name="task_description" id="task_description" cols="80" rows="10" placeholder="Описание задачи/проекта"></textarea>
                                                                </div>
                                                                <input type="submit" value="Закончить" class="ctf-button">
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if($select_task["status"] != "Отложено") { ?>
                                                    <br>
                                                    <a href="./vendor/vendor_change_status_task.php?id=<?= $id_task ?>&status=Отложено">Отложить</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php if($select_task["status"] != "Выполнено") { ?>
                                            <div class="mnw-comments">
                                                <div class="mnwc-wrapper">
                                                    <form method="post" id="create_comment" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_task" value="<?= $id_task ?>">
                                                        <div class="text-field text-field_floating-2">
                                                            <textarea name="task_description" id="task_description" cols="80" rows="10" placeholder="Оставить комментарий для других участников"></textarea>
                                                        </div>
                                                        <input type="file" id="pathimg">
                                                        <input type="submit" value="Оставить комментарий" class="ctf-button">
                                                    </form>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if(!empty($select_comments)) { ?>
                                    <div class="mnw-created-comments">
                                        <div class="mnwcc-wrapper">
                                            <h3>Комментарии</h3>
                                            <ul>
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
                                            </ul>
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