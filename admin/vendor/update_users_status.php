<?php
session_start();
require_once '../../vendor/settings.php';

if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `users` WHERE id = $num";
    $users  = $mysqli->query($sql1);
    $users = mysqli_fetch_assoc($users);
}

if ($users['status'] == 'Доступен') {
    $mysqli->query("UPDATE `users` SET `status` = 'Заблокирован' WHERE `users`.`id` = $num");
} else if ($users['status'] == 'Заблокирован') {
    $mysqli->query("UPDATE `users` SET `status` = 'Доступен' WHERE `users`.`id` = $num");
}
header('Location: /admin/user_mon.php');
