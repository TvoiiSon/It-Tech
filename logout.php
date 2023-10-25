<?php
setcookie("id_user", null, -1, "/");
setcookie("role", null, -1, "/");

header("Location: ./index.php");
?>