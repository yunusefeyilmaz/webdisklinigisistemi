<?php


$db_host = "localhost"; //XAMPP icin baglanti hostu
$db_user = "root"; //XAMPP icin root
$db_pass = ""; //XAMPP icin sifre yok
$db_name = "discirandevu"; //XAMPP icin database adi

$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
mysqli_set_charset($db, "utf8");
if (mysqli_connect_errno()) {
    echo "Bağlantı kurulamdı!";
    exit();
}

?>