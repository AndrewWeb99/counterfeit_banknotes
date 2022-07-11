<?php
session_start();
require_once 'settings.php';
// header('Location: /fact.php');
// $numb = $mysqli->query("SELECT MAX(`number`) FROM `facts`");
// $num = mysqli_fetch_all($numb);
// foreach ($num as $nu){
//     echo $nu[0];
// }
// $mysqli->query("INSERT INTO `facts` (`id`, `number`, `place`, `passed`) VALUES (NULL, '201', '26', '18')");

//Таблица для связи форм
$max_idmain = $mysqli->query("SELECT MAX(`number`) FROM `facts`");
$nummain = mysqli_fetch_all($max_idmain);
foreach ($nummain as $nus) {
    $max_id_facts = $nus[0];
}
$max_id_facts++;
$mysqli->query("INSERT INTO `dop_table` (`id_dop`, `numb_dop`) VALUES (NULL, '$max_id_facts')");

// Место обнаружения подделки добавление
$place_p = $_POST['place_p'];
$name_p = $_POST['name_p'];
$rn_p = $_POST['rn_p'];
$street_p = $_POST['street_p'];
$house_p = $_POST['house_p'];
$kv_p = $_POST['kv_p'];
$dolg_p = $_POST['dolg_p'];
$shir_p = $_POST['shir_p'];

// Сведения о лице, сдавшем подделку
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
$fio_re = $_POST['fio_re'];
$dolg_re = $_POST['dolg_re'];
$date_re = $_POST['date_re'];
$obst_re = $_POST['obst_re'];
$cep_re = $_POST['cep_re'];

//Загрузка файлов в Сведения о лице, сдавшем подделку
$uploaddir = '../images/uploads/';

$filename1 = $_FILES['anfas_pa']['name'];
$ext = substr($filename1, strpos($filename1, '.'), strlen($filename1) - 1);
$uploadfile1 = $uploaddir . uniqid('file_') . $ext;
move_uploaded_file($_FILES['anfas_pa']['tmp_name'], $uploadfile1);

$filename2 = $_FILES['profile_pa']['name'];
$ext = substr($filename2, strpos($filename2, '.'), strlen($filename2) - 1);
$uploadfile2 = $uploaddir . uniqid('file_') . $ext;
move_uploaded_file($_FILES['profile_pa']['tmp_name'], $uploadfile2);

$filename = $_FILES['dakt_pa']['name'];
$ext = substr($filename, strpos($filename, '.'), strlen($filename) - 1);
$uploadfile3 = $uploaddir . uniqid('file_') . $ext;
move_uploaded_file($_FILES['dakt_pa']['tmp_name'], $uploadfile3);



//Все записи в таблицу
//Запись в таблицу Место обнаружения подделки 
$mysqli->query("INSERT INTO `place` (`id`, `place_p`, `name_p`, `rn_p`, `street_p`, `house_p`, `kv_p`, `dolg_p`, `shir_p`) VALUES (NULL, '$place_p', '$name_p', '$rn_p', '$street_p', '$house_p', '$kv_p', '$dolg_p', '$shir_p')");


//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$max_jr = $mysqli->query("SELECT MAX(`id`) FROM `place`");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
    $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_facts', 'Место обнаружения подделки', '$max1', '$date_jr')");


//Запись в таблицу Сведения о лице, сдавшем подделку
$mysqli->query("INSERT INTO `passed` (`id_pa`, `iin_pa`, `name_pa`, `fam_pa`, `otch_pa`, `role_pa`, `placework_pa`, `dolg_pa`, `risk_pa`, `bd_plo_pa`, `bd_lon_pa`, `bd_lro_pa`, `anfas_pa`, `profile_pa`, `dakt_pa`) VALUES (NULL, '$iin_pa', '$name_pa', '$fam_pa', '$otch_pa', '$role_pa', '$placework_pa', '$dolg_pa', '$risk_pa', '$bd_plo_pa', '$bd_lon_pa', '$bd_lro_pa', '$uploadfile1', '$uploadfile2', '$uploadfile3')");



//Запись в журнал
$max_jr = $mysqli->query("SELECT MAX(`id_pa`) FROM `passed`");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
    $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_facts', 'Сведения о лице, сдавшем подделку', '$max1', '$date_jr');");



//Запись в таблицу Сведения о регистрации
$mysqli->query("INSERT INTO `regist` (`id_re`, `fio_re`, `dolg_re`, `date_re`, `obst_re`, `cep_re`) VALUES (NULL, '$fio_re', '$dolg_re', '$date_re', '$obst_re', '$cep_re')");

//Запись в журнал
$max_jr = $mysqli->query("SELECT MAX(`id_re`) FROM `regist`");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
    $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_facts', 'Сведения о регистрации', '$max1', '$date_jr')");


if ($cep_re == 'Есть') {
    header('Location: /cep.php');
} else {
    header('Location: /banknote.php');
}
