<?php
session_start();
require_once '../vendor/settings.php';

//Связь
$max_idmain = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
$nummain = mysqli_fetch_all($max_idmain);
foreach ($nummain as $nus) {
    $max_id_dop = $nus[0];
};

// Данные подделки
$iin_me = $_POST['iin_me'];
$fam_me = $_POST['fam_me'];
$name_me= $_POST['name_me'];
$otch_me = $_POST['otch_me'];
$sud_me = $_POST['sud_me'];

$adress_me = $_POST['adress_me'];
$type_doc_me = $_POST['type_doc_me'];
$ser_me = $_POST['ser_me'];
$num_me= $_POST['num_me'];
$role_me = $_POST['role_me'];

$mysqli->query("INSERT INTO `members` (`id_me`, `num_fact_me`, `iin_me`, `fam_me`, `name_me`, `otch_me`, `sud_me`, `adress_me`, `type_doc_me`, `ser_me`, `num_me`, `role_me`) VALUES (NULL, '$max_id_dop', '$iin_me', '$fam_me', '$name_me', '$otch_me', '$sud_me', '$adress_me', '$type_doc_me', '$ser_me', '$num_me', '$role_me')");

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$max_jr = $mysqli->query("SELECT MAX(`id_me`) FROM `members`");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
    $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'Участники уголовного дела', '$max1', '$date_jr');");




header('Location: uch.php');