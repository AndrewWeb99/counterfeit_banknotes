<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/facts.css">
    <link rel="stylesheet" href="/admin/css/style.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Управление пользователями</title>
</head>

<body>
     <!-- заголовок -->
     <?php require('../blocks/header.php'); ?>
    <!-- основа -->
    <!-- Форма добавления пользователя -->
    <div class="container" style="padding: 0;">
        <?php require('../blocks/nav.php'); ?>
        <form action="vendor/register.php" method="post">

            <h1>Добавление пользователя</h1>
            <hr>
            <label for="login"><b>Логин</b></label>
            <input type="text" name="login" required>

            <label for="name"><b>Имя сотрудника</b></label>
            <input type="text" name="name" required>

            <label for="role"><b>Роль сотрудника</b></label><br>
            <select name="role" required>
                <option value="Аналитик" selected>Аналитик</option>
                <option value="Администратор">Администратор</option>
                <option value="Оперативный сотрудник">Оперативный сотрудник</option>
            </select>
            <br><br>
            <label for="password"><b>Пароль</b></label>
            <input type="password" name="password" required>

            <hr>
            <!-- Вывод сообщения о проверке данных (доп валидация) -->
            <?php
            if (isset($_SESSION['is_error']) && $_SESSION['is_error'] === true) {
            ?>
                <div class="alert_user">
                    <?= $_SESSION['error_message'] ?>
                </div>
            <?php
            }
            unset($_SESSION['is_error']);
            unset($_SESSION['error_message']);
            ?>
            <!-- Информация об успешной регистрации -->
            <?php
            if (isset($_SESSION['is_success_register']) && $_SESSION['is_success_register'] === true) {
            ?>
                <div class="success_user">
                    <?= $_SESSION['success_message'] ?>
                </div>
            <?php
            }
            unset($_SESSION['is_success_register']);
            unset($_SESSION['success_message']);
            ?>
            <button type="submit" class="registerbtn">Добавить пользователя</button>


        </form>
    </div>
</body>

</html>