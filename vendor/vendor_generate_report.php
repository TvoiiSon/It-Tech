<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$id = $_COOKIE['id_user'];
$start_date = $_POST["start_date"];
$due_date = $_POST["due_date"];

$select_complite_tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `status`='Выполнено' AND `start_date`>='$start_date' AND `due_date`<='$due_date' AND `id_owner`='$id'");
$select_complite_tasks = mysqli_fetch_all($select_complite_tasks);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CASTCASEDOTCOME | It-Tech</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
    <?php if($_COOKIE['role'] == 2) { ?>
        <div class="container">
            <div class="row">
                <a href="../index.php">На главную</a>
                <h3>Отчет за период <?= $start_date ?> / <?= $due_date ?></h3>
                <table class="table-fill">
                    <thead>
                        <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">Название задачи</th>
                            <th class="text-left">Описание задачи</th>
                            <th class="text-left">Дата начала работы</th>
                            <th class="text-left">Дата завершения работы</th>
                            <th class="text-left">Категория задачи</th>
                            <th class="text-left">Статус</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        <?php
                            if (!empty($select_complite_tasks)) {
                                foreach ($select_complite_tasks as $task) {
                                    $id_task_categ = $task[6];
                                    $select_category = mysqli_query($connect, "SELECT * FROM `category` WHERE `id`='$id_task_categ'");
                                    $select_category = mysqli_fetch_assoc($select_category);
                                    echo '<tr>';
                                    echo '<td class="text-left">' . $task[0] . '</td>';
                                    echo '<td class="text-left">' . $task[2] . '</td>';
                                    echo '<td class="text-left">' . $task[3] . '</td>';
                                    echo '<td class="text-left">' . $task[4] . '</td>';
                                    echo '<td class="text-left">' . $task[5] . '</td>';
                                    echo '<td class="text-left">' . $select_category['category_name'] . '</td>';
                                    echo '<td class="text-left">' . $task[9] . '</td>';
                                    echo '</tr>';
                                }
                                echo '<tr>';
                                echo '<td class="text-left">Итого выполнено задач</td>';
                                echo '<td class="text-left" colspan="5">' . count($select_complite_tasks) . '</td>';
                                echo '</tr>';
                            } else {
                                echo '<tr><td class="text-left" colspan="7">Нет завершенных задач в указанный период.</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <canvas id="myChart" width="400" height="100"></canvas>
            </div>
        </div>
        <script>
            var dataFromPHP = <?php echo json_encode($select_complite_tasks); ?>;
            console.log(dataFromPHP);
            var canvas = document.getElementById('myChart');
            var ctx = canvas.getContext('2d');
            var months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
            var completedTasksData = new Array(12).fill(0);
            var labels = [];
            for (var i = 0; i < months.length; i++) {
                labels.push(months[i]);
            }
            var completedTasksData = [];
            for (var i = 0; i < months.length; i++) {
                var monthTasks = dataFromPHP.filter(function (task) {
                    var taskDate = new Date(task[5]);
                    return taskDate.getMonth() === i;
                });
                completedTasksData.push(monthTasks.length);
            }
            console.log(completedTasksData);
            var data = {
                labels: labels,
                datasets: [{
                    label: 'Количество выполненных задач',
                    data: completedTasksData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php } else { ?>
        <h2>Даная страница не доступна для администратора</h2>
    <?php } ?>
        <script src="https://kit.fontawesome.com/61b86703fe.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>