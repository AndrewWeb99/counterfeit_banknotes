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
$uploaddir = '../images/uploads_exp/';
if (isset($_FILES['material_ex']['name'])) {

    $total_files = count($_FILES['material_ex']['name']);

    for ($key = 0; $key < $total_files; $key++) {

        // Check if file is selected
        if (
            isset($_FILES['material_ex']['name'][$key])
            && $_FILES['material_ex']['size'][$key] > 0
        ) {

            $filename = $_FILES['material_ex']['name'][$key];
            $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
            $target = $uploaddir.uniqid('file_').$ext;
            $tmp  = $_FILES['material_ex']['tmp_name'][$key];
            move_uploaded_file($tmp, $target);
            $mysqli->query("INSERT INTO `material_expertise` (`ied_mex`, `num_mex`, `path_mex`) VALUES (NULL, '$max_id_dop', '$target')");
        }
    }
}

$mysqli->query("INSERT INTO `expertise` (`id_ex`, `num_ex`, `nom_ex`, `fio_ex`, `date_ex`, `spos_ex`, `color_ex`, `dlina_ex`, `tols_ex`, `lumen_ex`, `obl_ex`, `xarp_ex`, `height_ex`, `shield_ex`, `fil_ex`, `water_ex`, `sovmimg_ex`, `met_ex`, `opt_ex`, `pril_num_ex`) VALUES (NULL, '$max_id_dop', '$nom_ex', '$fio_ex', '$date_ex', '$spos_ex', '$color_ex', '$dlina_ex', '$tols_ex', '$lumen_ex', '$obl_ex', '$xarp_ex', '$height_ex', '$shield_ex', '$fil_ex', '$water_ex', '$sovmimg_ex', '$met_ex', '$opt_ex', '$max_id_dop')");

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$max_jr = $mysqli->query("SELECT MAX(`id_ex`) FROM `expertise`");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
    $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'Экспертиза', '$max1', '$date_jr');");


header('Location: /expertise.php');
