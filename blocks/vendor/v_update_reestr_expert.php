<?php
session_start();
require_once '../../vendor/settings.php';

// Данные подделки


$id_ex = $_POST['id_ex'];
$pril_num_ex = $_POST['pril_num_ex'];

$nom_ex = $_POST['nom_ex'];
$fio_ex = $_POST['fio_ex'];
$date_ex = $_POST['date_ex'];
$spos_ex = $_POST['spos_ex'];
$color_ex = $_POST['color_ex'];
$dlina_ex = $_POST['dlina_ex'];
$tols_ex = $_POST['tols_ex'];
$lumen_ex = $_POST['lumen_ex'];
$obl_ex= $_POST['obl_ex'];
$xarp_ex = $_POST['xarp_ex'];
$height_ex = $_POST['height_ex'];
$shield_ex = $_POST['shield_ex'];
$fil_ex = $_POST['fil_ex'];
$water_ex = $_POST['water_ex'];
$sovmimg_ex = $_POST['sovmimg_ex'];
$met_ex = $_POST['met_ex'];
$opt_ex = $_POST['opt_ex'];
 
//Множественная загрузка
$uploaddir = '../../images/uploads_exp/';
if ($_FILES['material_ex']['name'][0] != '') {

    $mysqli->query("DELETE FROM `material_expertise` WHERE `material_expertise`.`num_mex` = $pril_num_ex");

    $total_files = count($_FILES['material_ex']['name']);

    for ($key = 0; $key < $total_files; $key++) {

        // Check if file is selected
        if (
            isset($_FILES['material_ex']['name'][$key])
            && $_FILES['material_ex']['size'][$key] > 0
        ) {

            $original_filename = $_FILES['material_ex']['name'][$key];
            $target = $uploaddir . basename($original_filename);
            $tmp  = $_FILES['material_ex']['tmp_name'][$key];
            move_uploaded_file($tmp, $target);
            $mysqli->query("INSERT INTO `material_expertise` (`ied_mex`, `num_mex`, `path_mex`) VALUES (NULL, '$pril_num_ex', '$target')");
        }
    }
}

$mysqli->query("UPDATE `expertise` SET `nom_ex` = '$nom_ex', `fio_ex` = '$fio_ex', `date_ex` = '$date_ex', `spos_ex` = '$spos_ex', `color_ex` = '$color_ex', `dlina_ex` = '$dlina_ex', `tols_ex` = '$tols_ex', `lumen_ex` = '$lumen_ex', `obl_ex` = '$obl_ex', `xarp_ex` = '$xarp_ex', `height_ex` = '$height_ex', `shield_ex` = '$shield_ex', `fil_ex` = '$fil_ex', `water_ex` = '$water_ex', `sovmimg_ex` = '$sovmimg_ex', `met_ex` = '$met_ex', `opt_ex` = '$opt_ex' WHERE `expertise`.`id_ex` = $id_ex");  

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$max_jr = $mysqli->query("SELECT `num_ex` FROM `expertise` WHERE `id_ex` = $id_ex");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
    $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$max1', 'Экспертиза', '$id_ex', '$date_jr');");



header('Location: /reestr_banknote.php');
