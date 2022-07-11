<?php
session_start();
require_once 'settings.php';
$login = $_POST['login'];
$password = $_POST['password'];

if ($login === '' || $password === '') {
    $_SESSION['is_error'] = true;
    $_SESSION['error_message'] = 'Ошибка входа. Проверьте данные!';
    header('Location: /login.php');
}

$user = $mysqli->query("SELECT * FROM `users` WHERE `login` = '$login'");
$user = $user->fetch_array();

if (!$user) {
    $_SESSION['is_error'] = true;
    $_SESSION['error_message'] = 'Ошибка входа. Проверьте данные!';
    header('Location: /login.php');
}

if (password_verify($password, $user["password"]) === true && $user["status"] == 'Доступен') {
    $_SESSION["auth"] = true;
    $_SESSION["user"] = [
        "id" => $user["id"],
        "login" => $user["login"],
        "name" => $user["name"],
        "role" => $user["role"],
        "status" => $user["status"]
    ];

    header('Location: /main.php');
} else if ($user["status"] == 'Заблокирован') {
    $_SESSION['is_error'] = true;
    $_SESSION['error_message'] = 'Данный пользователь заблокирован!';
    header('Location: /login.php');
} else {
    $_SESSION['is_error'] = true;
    $_SESSION['error_message'] = 'Ошибка входа. Проверьте данные!';
    header('Location: /login.php');
}
