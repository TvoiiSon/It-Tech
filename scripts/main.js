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

    // Установите начальное состояние в соответствии с выбором при загрузке страницы
    if (form1.checked) {
        onceCalendar.style.display = "block";
    } else if (form2.checked) {
        continuousCalendar.style.display = "block";
    }
});
