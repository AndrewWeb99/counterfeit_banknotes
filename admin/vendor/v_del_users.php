<?php
session_start();
require_once '../../vendor/settings.php';
if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $mysqli->query("DELETE FROM `users` WHERE `users`.`id` = $num");
}
header('Location: /admin/user_mon.php');