<?php
session_start();
require_once 'settings.php';

//Связь
$max_idmain = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
$nummain = mysqli_fetch_all($max_idmain);
foreach ($nummain as $nus) {
    $max_id_dop = $nus[0];
};

// Данные подделки
$num_er = $_POST['num_er'];
$num_ud_er = $_POST['num_ud_er'];
$kval_er= $_POST['kval_er'];
$org_er = $_POST['org_er'];
$status_er = $_POST['status_er'];

$date_reg_er = $_POST['date_reg_er'];
$date_v_er = $_POST['date_v_er'];
$perkval_er = $_POST['perkval_er'];
$role_er= $_POST['role_er'];
$sot_er = $_POST['sot_er'];

$mysqli->query("INSERT INTO `edrd` (`id_er`, `num_er`, `num_ud_er`, `kval_er`, `org_er`, `status_er`, `date_reg_er`, `date_v_er`, `perkval_er`, `role_er`, `sot_er`, `uud_num_er`, `ppdr_num_er`, `pud_num_er`) VALUES (NULL, '$num_er', '$num_ud_er', '$kval_er', '$org_er', '$status_er', '$date_reg_er', '$date_v_er', '$perkval_er', '$role_er', '$sot_er', '$max_id_dop', '$max_id_dop', '1')");

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$max_jr = $mysqli->query("SELECT MAX(`id_er`) FROM `edrd`");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
    $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'ЕРДР/УД', '$max1', '$date_jr');");


//Формирование связей
//Вытащить айди для ввода в основную таблицу

//Место обнаружения подделки
$max_id = $mysqli->query("SELECT MAX(`id`) FROM `place`");
$num = mysqli_fetch_all($max_id);
foreach ($num as $nus) {
    $max_id_place = $nus[0];
}

// Сведения о лице, сдавшем подделку
$max_idtwo = $mysqli->query("SELECT MAX(`id_pa`) FROM `passed`");
$numtwo = mysqli_fetch_all($max_idtwo);
foreach ($numtwo as $nus) {
    $max_id_passed = $nus[0];
}

//Сведения о регистрации
$max_idthree = $mysqli->query("SELECT MAX(`id_re`) FROM `regist`");
$numthree = mysqli_fetch_all($max_idthree);
foreach ($numthree as $nus) {
    $max_id_regsit = $nus[0];
}

//Цепочка
// $max_idthree = $mysqli->query("SELECT MAX(`numb_ch`) FROM `chain`");
// $numthree = mysqli_fetch_all($max_idthree);
// foreach ($numthree as $nus){
//     $max_id_cep = $nus[0];
// }

$max_idthree = $mysqli->query("SELECT MAX(`id_er`) FROM `edrd`");
$numthree = mysqli_fetch_all($max_idthree);
foreach ($numthree as $nus) {
    $max_id_edrd = $nus[0];
}

//Главная таблица
$max_idmain = $mysqli->query("SELECT MAX(`number`) FROM `facts`");
$nummain = mysqli_fetch_all($max_idmain);
foreach ($nummain as $nus) {
    $max_id_facts = $nus[0];
}
$max_id_facts++;




// добавление в основную таблицу записи (связи с данными)
$mysqli->query("INSERT INTO `facts` (`id`, `number`, `place`, `passed`, `regsit`, `chain`, `banknote`, `erdr`) VALUES (NULL, '$max_id_dop', '$max_id_place', '$max_id_passed', '$max_id_regsit', '$max_id_dop', '$max_id_dop', '$max_id_edrd')");
header('Location: /main.php');