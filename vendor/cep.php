<?php
session_start();
require_once 'settings.php';

$max_idmain = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
$nummain = mysqli_fetch_all($max_idmain);
foreach ($nummain as $nus) {
  $max_id_dop = $nus[0];
};


$ust_ch = $_POST['ust_ch'];
$iin_ch = $_POST['iin_ch'];
$fam_ch = $_POST['fam_ch'];
$name_ch = $_POST['name_ch'];
$otch_ch = $_POST['otch_ch'];
$place_ch = $_POST['place_ch'];
$work_ch = $_POST['work_ch'];
$role_ch = $_POST['role_ch'];
$date_ch = $_POST['date_ch'];

$anfas_ch = $_POST['anfas_ch'];
$prof_ch = $_POST['prof_ch'];
$dakt_ch = $_POST['dakt_ch'];

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
$uploaddir = '../images/uploads_cep/';
$filename = $_FILES['anfas_ch']['name'];
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
$uploadfile1 = $uploaddir.uniqid('file_').$ext;
move_uploaded_file($_FILES['anfas_ch']['tmp_name'], $uploadfile1);

$filename = $_FILES['prof_ch']['name'];
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
$uploadfile2 = $uploaddir.uniqid('file_').$ext;
move_uploaded_file($_FILES['prof_ch']['tmp_name'], $uploadfile2);

$filename = $_FILES['dakt_ch']['name'];
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
$uploadfile3 = $uploaddir.uniqid('file_').$ext;
move_uploaded_file($_FILES['dakt_ch']['tmp_name'], $uploadfile3);

//Множественная загрузка
if (isset($_FILES['material_ch']['name'])) {

  $total_files = count($_FILES['material_ch']['name']);

  for ($key = 0; $key < $total_files; $key++) {

    // Check if file is selected
    if (
      isset($_FILES['material_ch']['name'][$key])
      && $_FILES['material_ch']['size'][$key] > 0
    ) {

      $filename = $_FILES['material_ch']['name'][$key];
      $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);

      $target = $uploaddir.uniqid('file_').$ext;
      $tmp  = $_FILES['material_ch']['tmp_name'][$key];
      move_uploaded_file($tmp, $target);
      $mysqli->query("INSERT INTO `material_chain` (`id_mch`, `numb_mch`, `path_mch`) VALUES (NULL, '$max_id_dop', '$target ')");
    }
  }
}



//Все записи в таблицу
$mysqli->query("INSERT INTO `chain` (`id_ch`, `ust_ch`, `numb_ch`, `iin_ch`, `fam_ch`, `name_ch`, `otch_ch`, `place_ch`, `work_ch`, `role_ch`, `date_ch`, `anfas_ch`, `prof_ch`, `dakt_ch`, `mest_ch`, `name_mest_ch`, `nsp_ch`, `street_ch`, `home_ch`, `dolg_ch`, `shir_ch`, `material_ch`, `comment_ch`) VALUES (NULL, '$ust_ch', '$max_id_dop', '$iin_ch', '$fam_ch', '$name_ch', '$otch_ch', '$place_ch', '$work_ch', '$role_ch', '$date_ch', '$uploadfile1', '$uploadfile2', '$uploadfile3', '$mest_ch', '$name_mest_ch', '$nsp_ch', '$street_ch', '$home_ch', '$dolg_ch', '$shir_ch', '$max_id_dop', '$comment_ch')");

//Запись в журнал
$d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
$max_jr = $mysqli->query("SELECT MAX(`id_ch`) FROM `chain`");
$max = mysqli_fetch_all($max_jr);
foreach ($max as $nus) {
  $max1 = $nus[0];
}
$date_jr = date('Y/m/d H:i:s');
$mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'Цепочка возникновения', '$max1', '$date_jr');");




header('Location: /cep.php');
