<?php

session_start();
require_once '../../vendor/settings.php';

//Определение данных нового пользователя
$login = $_POST['login'];
$name = $_POST['name'];
$role = $_POST['role'];
$password = $_POST['password'];

// Проверка полученных данных
if ($login === '' || $name === '' || $password === '' || $role === '') {
    $_SESSION['is_error'] = true;
    $_SESSION['error_message'] = 'Проверьте правильность введенных полей!!!';
    header('Location: /admin/users.php');
}
//хэширование пароля (для безопасности)
$pass_block = password_hash($password, PASSWORD_DEFAULT);
//Добавление в БД
$mysqli->query("INSERT INTO `users` (`id`, `login`, `name`, `role`, `password`) VALUES (NULL, '$login', '$name', '$role', '$pass_block')");

$_SESSION['is_success_register'] = true;
$_SESSION['success_message'] = 'Регистрация прошла успешно.';
header('Location: /admin/users.php');
?>
