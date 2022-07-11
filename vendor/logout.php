<?php
session_start();
$_SESSION['auth'] = false;
unset($_SESSION['user']);
header('Location: /login.php')
?>