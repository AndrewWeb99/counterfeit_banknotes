<?php
session_start();
require_once '../../vendor/settings.php';

if (isset($_GET['number'])) {
    $num = $_GET['number'];
    $sql1 = "SELECT * FROM `chain` WHERE id_ch = $num";
    $chain  = $mysqli->query($sql1);
    $chain = mysqli_fetch_assoc($chain);
    $sql1 = "DELETE FROM `material_chain` WHERE `material_chain`.`numb_mch` = ".$chain['material_ch'];

    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT `numb_ch` FROM `chain` WHERE `id_ch` = $num");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Удаление', '$max1', 'Цепочка возникновения', '$num', '$date_jr');");

    $mat = $mysqli->query($sql1);
    $sql1 = "DELETE FROM `chain` WHERE `chain`.`id_ch` = $num";
    $ch = $mysqli->query($sql1);
    
}
header('Location: /reestr_facts.php');

?>
