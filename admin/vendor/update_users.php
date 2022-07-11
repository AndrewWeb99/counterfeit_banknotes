<?php
session_start();
require_once '../../vendor/settings.php';
if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `users` WHERE id = $num";
    $users  = $mysqli->query($sql1);
    $users = mysqli_fetch_assoc($users);
}
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
    <?php require('../../blocks/header.php'); ?>
    <!-- основа -->
    <!-- Форма добавления пользователя -->
    <div class="container" style="padding: 0;">
        <?php require('../../blocks/nav.php'); ?>
        <form action="v_update_users.php" method="post">
            <h1>Изменение пользователя</h1>
            <hr>
            <input type="text" id="id" name="id" required value="<?= $users['id'] ?>" style="display: none;">

            <label for="login"><b>Логин</b></label>
            <input type="text" name="login" required value="<?= $users['login'] ?>">

            <label for="name"><b>Имя сотрудника</b></label>
            <input type="text" name="name" required value="<?= $users['name'] ?>">

            <label for="role"><b>Роль сотрудника</b></label><br>
            <input type="text" id="role_name" required value="<?= $users['role'] ?>" style="display: none;">
            <select name="role" id="role" required>
                <option id="role_type1" value="Аналитик">Аналитик</option>
                <option id="role_type2" value="Администратор">Администратор</option>
                <option id="role_type3" value="Оперативный сотрудник">Оперативный сотрудник</option>
            </select>
            <br><br>
            <label for="password"><b>Новый пароль</b></label>
            <input type="password" name="password">
            <hr>
            <button type="submit" class="registerbtn">Изменить данные пользователя</button>
        </form>
    </div>
    <script>
        let role_name = document.getElementById("role_name");
        let role_type1 = document.getElementById("role_type1");
        let role_type2 = document.getElementById("role_type2");
        let role_type3 = document.getElementById("role_type3");
        document.addEventListener("DOMContentLoaded", function() {
            if (role_name.value == "Аналитик") {
                role_type1.setAttribute("selected", "selected");
            } else if (role_name.value == "Администратор") {
                role_type2.setAttribute("selected", "selected");
            }else if (role_name.value == "Оперативный сотрудник") {
                role_type3.setAttribute("selected", "selected");
            }
        });
    </script>
</body>

</html>