document.addEventListener("DOMContentLoaded", function () {
    var form1 = document.getElementById("form1");
    var form2 = document.getElementById("form2");
    var onceCalendar = document.getElementById("once_calendar");
    var continuousCalendar = document.getElementById("continuous_calendar");
    var dueDateInput = document.getElementById("due_date");

    form1.addEventListener("change", function () {
        if (form1.checked) {
            onceCalendar.style.display = "block";
            continuousCalendar.style.display = "none";
        }
    });

    form2.addEventListener("change", function () {
        if (form2.checked) {
            onceCalendar.style.display = "none";
            continuousCalendar.style.display = "block";
        }
    });

    if (form1.checked) {
        onceCalendar.style.display = "block";
    } else if (form2.checked) {
        continuousCalendar.style.display = "block";
    }
});
$(document).ready(function () {
    $("#create_task").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "./vendor/vendor_create_task.php",
            data: formData,
            success: function (response) {
                if (response === "success") {
                    alert("Задача/проект успешно добавлен(а)!");
                    location.reload();
                } else {
                    alert("Что-то пошло не так. Пожалуйста, попробуйте еще раз.");
                    location.reload();
                }
            },
            error: function (error) {
                alert("Произошла ошибка при отправке данных на сервер.");
            }
        });
    });
});
$(document).ready(function () {
    $("#create_user").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "./vendor/vendor_create_user.php",
            data: formData,
            success: function (response) {
                if (response === "success") {
                    alert("Пользователь успешно создан!");
                    location.reload();
                } else {
                    alert("Что-то пошло не так. Пожалуйста, попробуйте еще раз.");
                    location.reload();
                }
            },
            error: function (error) {
                alert("Произошла ошибка при отправке данных на сервер.");
            }
        });
    });
});
$(document).ready(function () {
    $("#link_participant").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "./vendor/vendor_link_participant.php",
            data: formData,
            success: function (response) {
                if (response === "success") {
                    alert("Пользователь успешно привязан!");
                    location.reload();
                } else {
                    alert("Что-то пошло не так. Пожалуйста, попробуйте еще раз.");
                    location.reload();
                }
            },
            error: function (error) {
                alert("Произошла ошибка при отправке данных на сервер.");
            }
        });
    });
});
$(document).ready(function () {
    $("#create_comment").submit(function (event) {
        event.preventDefault();

        var fileInput = document.getElementById('pathimg');
        var formData = new FormData(this);

        var selectedFile = fileInput.files.length > 0 ? fileInput.files[0] : null;
        formData.append('pathimg', selectedFile);

        $.ajax({
            type: "POST",
            url: "./vendor/vendor_create_comment.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response === "success") {
                    alert("Комментарий успешно прикреплен!");
                    location.reload();
                } else {
                    alert("Что-то пошло не так. Пожалуйста, попробуйте еще раз.");
                    location.reload();
                }
            },
            error: function (error) {
                alert("Произошла ошибка при отправке данных на сервер.");
            }
        });
    });
});
$(document).ready(function () {
    $("#complete_task").submit(function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "./vendor/vendor_complete_task.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response === "success") {
                    alert("Задача успешно выполнена!");
                    location.reload();
                } else {
                    alert("Что-то пошло не так. Пожалуйста, попробуйте еще раз.");
                    location.reload();
                }
            },
            error: function (error) {
                alert("Произошла ошибка при отправке данных на сервер.");
            }
        });
    });
});