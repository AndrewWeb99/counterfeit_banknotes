<?php
session_start();
require_once '../../vendor/settings.php';


// Данные подделки

$id_ba = $_POST['id_ba'];

$type_ba = $_POST['type_ba'];
$val_ba = $_POST['val_ba'];
$suven_ba = $_POST['suven_ba'];
$combo_ba = $_POST['combo_ba'];
$ser_one_ba = $_POST['ser_one_ba'];
$ser_two_ba = $_POST['ser_two_ba'];
$number_one_ba = $_POST['number_one_ba'];
$number_two_ba = $_POST['number_two_ba'];
$date_ba = $_POST['date_ba'];
$nominal_ba = $_POST['nominal_ba'];
$kol_ba = $_POST['kol_ba'];
$material_ba = $_POST['material_ba[]'];

$material_num_ba = $_POST['material_num_ba'];


//Проверки
if ($type_ba == 'Банкнота') {
    $suven_ba = NULL;
}
if ($type_ba == 'Монета') {
    $combo_ba = NULL;
    $combo_ba = NULL;
    $ser_one_ba = NULL;
    $ser_two_ba = NULL;
    $number_one_ba = NULL;
    $number_two_ba = NULL;
}

//Множественная загрузка

$uploaddir = '../../images/uploads_bank/';
if ($_FILES['material_ba']['name'][0] != '') {

    $mysqli->query("DELETE FROM `material_banknote` WHERE `material_banknote`.`numb_mba` = $material_num_ba");

    $total_files = count($_FILES['material_ba']['name']);

    for ($key = 0; $key < $total_files; $key++) {

        // Check if file is selected
        if (
            isset($_FILES['material_ba']['name'][$key])
            && $_FILES['material_ba']['size'][$key] > 0
        ) {

            $original_filename = $_FILES['material_ba']['name'][$key];
            $target = $uploaddir . basename($original_filename);
            $tmp  = $_FILES['material_ba']['tmp_name'][$key];
            move_uploaded_file($tmp, $target);
            $mysqli->query("INSERT INTO `material_banknote` (`id_mba`, `numb_mba`, `path_mba`) VALUES (NULL, '$material_num_ba', '$target ')");
        }
    }
}

//Запись в таблицу Данные банкноты
if ($type_ba == 'Банкнота' and $combo_ba == 'Половинчатая') {
    $mysqli->query("UPDATE `banknote` SET `type_ba` = '$type_ba', `val_ba` = '$val_ba', `suven_ba` = NULL, `combo_ba` = '$combo_ba', `ser_one_ba` = '$ser_one_ba', `ser_two_ba` = '$ser_two_ba', `number_one_ba` = '$number_one_ba', `number_two_ba` = '$number_two_ba', `date_ba` = '$date_ba', `nominal_ba` = '$nominal_ba', `kol_ba` = '$kol_ba' WHERE `banknote`.`id_ba` = $id_ba");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT `numb_ba` FROM `banknote` WHERE `id_ba` = $id_ba");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$max1', 'Данные подделки', '$id_ba', '$date_jr');");
}

if ($type_ba == 'Банкнота' and $combo_ba == 'Обычная') {
    $mysqli->query("UPDATE `banknote` SET `type_ba` = '$type_ba', `val_ba` = '$val_ba', `suven_ba` = NULL, `combo_ba` = '$combo_ba', `ser_one_ba` = '$ser_one_ba', `ser_two_ba` = NULL, `number_one_ba` = '$number_one_ba', `number_two_ba` = NULL, `date_ba` = '$date_ba', `nominal_ba` = '$nominal_ba', `kol_ba` = '$kol_ba' WHERE `banknote`.`id_ba` = $id_ba");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT `numb_ba` FROM `banknote` WHERE `id_ba` = $id_ba");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$max1', 'Данные подделки', '$id_ba', '$date_jr');");
}

if ($type_ba == 'Банкнота' and $combo_ba == 'Подлинная') {
    $mysqli->query("UPDATE `banknote` SET `type_ba` = '$type_ba', `val_ba` = '$val_ba', `suven_ba` = NULL, `combo_ba` = '$combo_ba', `ser_one_ba` = '$ser_one_ba', `ser_two_ba` = NULL, `number_one_ba` = '$number_one_ba', `number_two_ba` = NULL, `date_ba` = '$date_ba', `nominal_ba` = '$nominal_ba', `kol_ba` = '$kol_ba' WHERE `banknote`.`id_ba` = $id_ba");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT `numb_ba` FROM `banknote` WHERE `id_ba` = $id_ba");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$max1', 'Данные подделки', '$id_ba', '$date_jr');");
}

if ($type_ba == 'Монета') {
    $combo_ba = NULL;
    $ser_one_ba = NULL;
    $ser_two_ba = NULL;
    $number_one_ba = NULL;
    $number_two_ba = NULL;
    $mysqli->query("UPDATE `banknote` SET `type_ba` = '$type_ba', `val_ba` = '$val_ba', `suven_ba` = '$suven_ba', `combo_ba` = NULL, `ser_one_ba` = NULL, `ser_two_ba` = NULL, `number_one_ba` = NULL, `number_two_ba` = NULL, `date_ba` = '$date_ba', `nominal_ba` = '$nominal_ba', `kol_ba` = '$kol_ba' WHERE `banknote`.`id_ba` = $id_ba");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT `numb_ba` FROM `banknote` WHERE `id_ba` = $id_ba");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$max1', 'Данные подделки', '$id_ba', '$date_jr');");
}

header('Location: /reestr_banknote.php');
