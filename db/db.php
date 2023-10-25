<?php 
$connect = mysqli_connect("localhost", "root", "", "hackathon");
if (!$connect) {
    die("". mysqli_connect_error());
}
