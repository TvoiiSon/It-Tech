<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

$select_category = mysqli_query($connect,"SELECT * FROM `category`");
$select_category = mysqli_fetch_all($select_category);
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
                                    <span>Создать Задачу/Проект</span>
                                </div>
                            </div>
                            <hr>
                            <div class="mnw-body">
                                <form method="post" id="create_task" class="create_task_form">
                                    <div class="text-field text-field_floating-2">
                                        <input class="text-field__input" type="text" id="task_name" name="task_name" placeholder="Название задачи/проекта" required>
                                        <label class="text-field__label" for="task_name">Название задачи/проекта</label>
                                    </div>
                                    <div class="text-field text-field_floating-2">
                                        <textarea name="task_description" id="task_description" cols="80" rows="10" placeholder="Описание задачи/проекта" required></textarea>
                                    </div>
                                    <div>
                                        <input type="radio" id="form1" name="work_type" value="once">
                                        <label for="form1">Разовая работа</label>
                                        <br>
                                        <input type="radio" id="form2" name="work_type" value="continuous">
                                        <label for="form2">Продолжительная работа</label>
                                    </div>
                                    <div id="once_calendar" style="display: none">
                                        <label for="single_date_start">Дата начала</label>
                                        <input type="date" name="single_date_start" id="single_date_start">
                                    </div>
                                    <div id="continuous_calendar" style="display: none">
                                        <label for="start_date">Срок начала выполнения</label>
                                        <input type="date" name="start_date" id="start_date">
                                        <br>
                                        <label for="due_date">Срок конца выполнения</label>
                                        <input type="date" name="due_date" id="due_date">
                                    </div>
                                    <select name="category" required>
                                        <?php foreach($select_category as $category) { ?>
                                            <option value="<?= $category[0] ?>"><?= $category[1] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div>
                                        <p>Приоритет задачи/проекта</p>
                                        <div>
                                            <label for="priority1">1</label>
                                            <input type="radio" id="priority1" name="priority" value="1" required><br>
                                            <label for="priority2">2</label>
                                            <input type="radio" id="priority2" name="priority" value="2" required><br>
                                            <label for="priority3">3</label>
                                            <input type="radio" id="priority3" name="priority" value="3" required><br>
                                            <label for="priority4">4</label>
                                            <input type="radio" id="priority4" name="priority" value="4" required><br>
                                            <label for="priority5">5</label>
                                            <input type="radio" id="priority5" name="priority" value="5" required><br>
                                            <label for="priority6">6</label>
                                            <input type="radio" id="priority6" name="priority" value="6" required><br>
                                            <label for="priority7">7</label>
                                            <input type="radio" id="priority7" name="priority" value="7" required><br>
                                            <label for="priority8">8</label>
                                            <input type="radio" id="priority8" name="priority" value="8" required><br>
                                            <label for="priority9">9</label>
                                            <input type="radio" id="priority9" name="priority" value="9" required><br>
                                            <label for="priority10">10</label>
                                            <input type="radio" id="priority10" name="priority" value="10" required><br>
                                        </div>
                                    </div>
                                    <input type="submit" value="Создать" class="ctf-button">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./scripts/main.js"></script>
        <script src="https://kit.fontawesome.com/61b86703fe.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>