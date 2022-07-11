<?php
session_start();
require_once '../../vendor/settings.php';


$ref = $_POST['ref'];
// Место обнаружения подделки 
$id = $_POST['id'];
$place_p = $_POST['place_p'];
$name_p = $_POST['name_p'];
$rn_p = $_POST['rn_p'];
$street_p = $_POST['street_p'];
$house_p = $_POST['house_p'];
$kv_p = $_POST['kv_p'];
$dolg_p = $_POST['dolg_p'];
$shir_p = $_POST['shir_p'];

// Сведения о лице, сдавшем подделку
$id_pa = $_POST['id_pa'];
$iin_pa = $_POST['iin_pa'];
$name_pa = $_POST['name_pa'];
$fam_pa = $_POST['fam_pa'];
$otch_pa = $_POST['otch_pa'];
$role_pa = $_POST['role_pa'];
$placework_pa = $_POST['placework_pa'];
$dolg_pa = $_POST['dolg_pa'];
$risk_pa = $_POST['risk_pa'];
$bd_plo_pa = $_POST['bd_plo_pa'];
$bd_lon_pa = $_POST['bd_lon_pa'];
$bd_lro_pa = $_POST['bd_lro_pa'];

//Сведения о регистрации

$id_re = $_POST['id_re'];
$fio_re = $_POST['fio_re'];
$dolg_re = $_POST['dolg_re'];
$date_re = $_POST['date_re'];
$obst_re = $_POST['obst_re'];
$cep_re = $_POST['cep_re'];

//Загрузка файлов в Сведения о лице, сдавшем подделку
$uploaddir = '../../images/uploads/';
if ($_FILES['anfas_pa'] != '') {
    $uploadfile1 = $uploaddir . basename($_FILES['anfas_pa']['name']);
    move_uploaded_file($_FILES['anfas_pa']['tmp_name'], $uploadfile1);
    $mysqli->query("UPDATE `passed` SET `anfas_pa` = '$uploadfile1' WHERE `passed`.`id_pa` = $id_pa");
}
if ($_FILES['profile_pa'] != '') {
    $uploadfile2 = $uploaddir . basename($_FILES['profile_pa']['name']);
    move_uploaded_file($_FILES['profile_pa']['tmp_name'], $uploadfile2);
    $mysqli->query("UPDATE `passed` SET `profile_pa` = '$uploadfile2' WHERE `passed`.`id_pa` = $id_pa");
}
if ($_FILES['dakt_pa'] != '') {
    $uploadfile3 = $uploaddir . basename($_FILES['dakt_pa']['name']);
    move_uploaded_file($_FILES['dakt_pa']['tmp_name'], $uploadfile3);
    $mysqli->query("UPDATE `passed` SET `dakt_pa` = '$uploadfile3' WHERE `passed`.`id_pa` = $id_pa");
}

 









//Все записи в таблицу
//Запись в таблицу Место обнаружения подделки 
$mysqli->query("UPDATE `place` SET `place_p` = '$place_p', `name_p` = '$name_p', `rn_p` = '$rn_p', `street_p` = '$street_p', `house_p` = '$house_p', `kv_p` = '$kv_p', `dolg_p` = '$dolg_p', `shir_p` = '$shir_p' WHERE `place`.`id` = $id");

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
// $max_jr = $mysqli->query("SELECT `id` FROM `place` WHERE `place`.`id` = $id");
// $max = mysqli_fetch_all($max_jr);
// foreach ($max as $nus) {
//     $max1 = $nus[0];
// }
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$ref', 'Место обнаружения подделки', '$id', '$date_jr');");


//Запись в таблицу Сведения о лице, сдавшем подделку
$mysqli->query("UPDATE `passed` SET `iin_pa` = '$iin_pa', `name_pa` = '$name_pa', `fam_pa` = '$fam_pa', `otch_pa` = '$otch_pa', `role_pa` = '$role_pa', `placework_pa` = '$placework_pa', `dolg_pa` = '$dolg_pa', `risk_pa` = '$risk_pa', `bd_plo_pa` = '$bd_plo_pa', `bd_lon_pa` = '$bd_lon_pa', `bd_lro_pa` = '$bd_lro_pa' WHERE `passed`.`id_pa` = $id_pa");

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$ref', 'Сведения о лице, сдавшем подделку', '$id_pa', '$date_jr');");





// //Запись в таблицу Сведения о регистрации
$mysqli->query("UPDATE `regist` SET `fio_re` = '$fio_re', `dolg_re` = '$dolg_re', `date_re` = '$date_re', `obst_re` = '$obst_re', `cep_re` = '$cep_re' WHERE `regist`.`id_re` = $id_re");

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$ref', 'Сведения о регистрации', '$id_re', '$date_jr');");



header('Location: ../update_reestr_facts.php?num='.$ref.'');

// if ($cep_re == 'Есть') {
//     header('Location: /cep.php');
// } else {
//     header('Location: /banknote.php');
// }
