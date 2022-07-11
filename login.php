<?php
session_start();
if(isset($_SESSION["auth"]) && $_SESSION["auth"] === true){
  header('Location: /main.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Авторизация</title>
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/auth.css">
  <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
</head>

<body>
  <form class="box" action="vendor/login.php" method="post">
    <img src="images/photo_2022-04-17_15-10-29.png" alt="">
    <h1>Авторизация</h1>
    <input class="login" type="text" name="login" placeholder="Логин">
    <input class="password" type="password" name="password" placeholder="Пароль">
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
    <input type="submit" value="Login">
  </form>


</body>

</html>