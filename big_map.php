<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}
require_once 'vendor/settings.php';
$sql1 = "SELECT * FROM place table1 JOIN facts table2 ON table1.id=table2.place";
$place  = $mysqli->query($sql1);
$place = mysqli_fetch_all($place);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/facts.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Карта фактов обнаружения</title>
</head>

<body>
    <style>
        #map {
            height: 100%;
            width: auto;
        }
    </style>
    <!-- заголовок -->
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>
        <div class="facts_three_section" style="width: 100%;">
            <div id="map"></div>
        </div>
    </div>

    <script>
        var arrObjects = [];
    </script>
    <script>
        <?php
        $i = -1;
        foreach ($place as $num) {
            $i++;
            echo '
        
        arrObjects[' . $i . '] = {
            id: "' . $num[0] . '",
            place: "' . $num[1] . '",
            name: "' . $num[2] . '",
            rn: "' . $num[3] . '",
            street: "' . $num[4] . '",
            house: "' . $num[5] . '",
            kv: "' . $num[6] . '",
            dolg: ' . $num[7] . ',
            shir: ' . $num[8] . ',
            number: ' . $num[10] . ',
        }
        ';
        };
        ?>
    </script>
    <script>
        console.log(arrObjects);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaCEckEfWrmRurAosjxEF4HMvuEijUgDE&callback=initMap&v=weekly" defer></script>
    <script src="/js/big_map.js"></script>
</body>

</html>