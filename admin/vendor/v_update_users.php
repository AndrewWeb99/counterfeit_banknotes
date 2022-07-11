<?php
session_start();
require_once '../../vendor/settings.php';

//Определение данных нового пользователя
$id = $_POST['id'];
$login = $_POST['login'];
$name = $_POST['name'];
$role = $_POST['role'];
$password = $_POST['password'];

// Проверка полученных данных
if ($password != '') {
    $pass_block = password_hash($password, PASSWORD_DEFAULT);
    $mysqli->query("UPDATE `users` SET `login` = '$login', `name` = '$name', `role` = '$role', `password` = '$pass_block' WHERE `users`.`id` = $id");
} else if ($password === '') {
    $mysqli->query("UPDATE `users` SET `login` = '$login', `name` = '$name', `role` = '$role' WHERE `users`.`id` = $id");
}
header('Location: /admin/vendor/update_users.php?num=' . $id);
