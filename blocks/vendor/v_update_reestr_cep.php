<?php
session_start();
require_once '../../vendor/settings.php';
 
 
$ref = $_POST['ref'];
$id_ch = $_POST['id_ch'];
$material_ch = $_POST['material_ch'];

$ust_ch = $_POST['ust_ch'];
$iin_ch = $_POST['iin_ch'];
$fam_ch = $_POST['fam_ch'];
$name_ch = $_POST['name_ch'];
$otch_ch = $_POST['otch_ch'];
$place_ch = $_POST['place_ch'];
$work_ch = $_POST['work_ch'];
$role_ch = $_POST['role_ch'];
$date_ch = $_POST['date_ch'];



$mest_ch = $_POST['mest_ch'];
$name_mest_ch = $_POST['name_mest_ch'];
$nsp_ch = $_POST['nsp_ch'];
$street_ch = $_POST['street_ch'];
$home_ch = $_POST['home_ch'];
$dolg_ch = $_POST['dolg_ch'];
$shir_ch = $_POST['shir_ch'];

// $material_ch = $_POST['material_ch'];

$comment_ch = $_POST['comment_ch'];



//Загрузка файлов в возникновения
$uploaddir = '../../images/uploads_cep/';
if ($_FILES['anfas_ch']['name'] != '') {
    $uploadfile1 = $uploaddir . basename($_FILES['anfas_ch']['name']);
    move_uploaded_file($_FILES['anfas_ch']['tmp_name'], $uploadfile1);
    $mysqli->query("UPDATE `chain` SET `anfas_ch` = '$uploadfile1' WHERE `chain`.`id_ch` = $id_ch");
}
if ($_FILES['prof_ch']['name'] != '') {
    $uploadfile2 = $uploaddir . basename($_FILES['prof_ch']['name']);
    move_uploaded_file($_FILES['prof_ch']['tmp_name'], $uploadfile2);
    $mysqli->query("UPDATE `chain` SET `prof_ch` = '$uploadfile2' WHERE `chain`.`id_ch` = $id_ch");
}
if ($_FILES['dakt_ch']['name'] != '') {
    $uploadfile3 = $uploaddir . basename($_FILES['dakt_ch']['name']);
    move_uploaded_file($_FILES['dakt_ch']['tmp_name'], $uploadfile3);
    $mysqli->query("UPDATE `chain` SET `dakt_ch` = '$uploadfile3' WHERE `chain`.`id_ch` = $id_ch");
}




//Множественная загрузка
if ($_FILES['material_ch']['name'][0] != '') {

    $mysqli->query("DELETE FROM `material_chain` WHERE `material_chain`.`numb_mch` = $material_ch");

    $total_files = count($_FILES['material_ch']['name']);

    for ($key = 0; $key < $total_files; $key++) {

        // Check if file is selected
        if (
            isset($_FILES['material_ch']['name'][$key])
            && $_FILES['material_ch']['size'][$key] > 0
        ) {

            $original_filename = $_FILES['material_ch']['name'][$key]; 
            $target = $uploaddir . basename($original_filename);
            $tmp  = $_FILES['material_ch']['tmp_name'][$key];
            move_uploaded_file($tmp, $target);
            $mysqli->query("INSERT INTO `material_chain` (`id_mch`, `numb_mch`, `path_mch`) VALUES (NULL, '$material_ch', '$target ')");
        }
    }
}



// //Все записи в таблицу
$mysqli->query("UPDATE `chain` SET `ust_ch` = '$ust_ch', `iin_ch` = '$iin_ch', `fam_ch` = '$fam_ch', `name_ch` = '$name_ch', `otch_ch` = '$otch_ch', `place_ch` = '$place_ch', `work_ch` = '$work_ch', `role_ch` = '$role_ch', `date_ch` = '$date_ch', `mest_ch` = '$mest_ch', `name_mest_ch` = '$name_mest_ch', `nsp_ch` = '$nsp_ch', `street_ch` = '$street_ch', `home_ch` = '$home_ch', `dolg_ch` = '$dolg_ch', `shir_ch` = '$shir_ch', `comment_ch` = '$comment_ch' WHERE `chain`.`id_ch` = $id_ch");

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$max_jr = $mysqli->query("SELECT `numb_ch` FROM `chain` WHERE `id_ch` = $id_ch");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
    $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Обновление', '$max1', 'Цепочка возникновения', '$id_ch', '$date_jr');");




header('Location: ../../reestr_facts.php');
