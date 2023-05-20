<?php

header('Content-type: text/html; charset=utf-8');

//veritabani baglanti
require_once "config.php";
//session kontrol
session_start();
if (!isset($_SESSION["login"])) {
    header('Location: ' . "login.php");
    exit;
}

//Simdiki tarih ya da secilen tarih ayari
$currentdate = date("Y-m-d");
if (isset($_POST["date"]) && $_POST["date"] != null) {
    $currentdate = $_POST["date"];
}
//Doktor bilgilerini cekme
$doctor_username = $_SESSION["login"];
$sqldoctordataquery = "SELECT * FROM `doktorlar` WHERE doktor_kullaniciadi='" . $doctor_username . "'";
$sqldoctordata = mysqli_query($db, $sqldoctordataquery);
if (!$sqldoctordata) {
    echo '<br>Doktor Verileri Alınamadi:';
}
//Doktor bilgileri
$doctordata = mysqli_fetch_array($sqldoctordata);
$doctor_name = $doctordata["doktor_adsoyadi"];
$doctor_id = $doctordata["doktor_id"];
$doctor_title = $doctordata["unvan"];

//Bu doktora ait olan hastalari veritabanidan cek
$sqluserdataquery = "SELECT * FROM `hastalar` WHERE doktor_id='" . $doctor_id . "' AND randevu_tarih='" . $currentdate . "'";
$sqluserdata = mysqli_query($db, $sqluserdataquery);
if (!$sqluserdata) {
    echo '<br>Hasta Verileri Alınamadi:';
}
//HTML
mysqli_close($db);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>DOKTOR PANEL</title>
    <link rel='stylesheet' href='site.css'>
</head>

<body class="bodylogin">
    <div style="width: 100%;">
        <div class="panelhead">
            <div class="panellogodiv">
                <img src="images/dentistlogo.png" width="100px" height="100px">
                <b class="logolbl">YILMAZ DİŞ KLİNİĞİ</b>
            </div>
            <div class="panellogodiv">
                <a href="createdoctor.php"><button class="panelbuttondoctor">DOKTOR EKLE</button></a>
                <a href="logout.php"><button class="panelbuttonexit">ÇIKIŞ YAP</button></a>
            </div>
        </div>
        <br>
        <div class="panelwelcome">
            <p class="panelwelcometext">HOŞGELDİNİZ,<br>
                <?php echo $doctor_title . " " . $doctor_name; ?>
            </p>
        </div>
        <?php echo "<h1 class='logolbl'>" . $currentdate . " Tarihli Randevularınız</h1>"; ?>
        <div class="panelilllist">
            <div style='width: 100%;flex-direction: column;'>
                <?php
                if (mysqli_num_rows($sqluserdata) == 0) {
                    echo "
                        <div class='sendbody'>
                        <p class='indexlabelinput'>BU TARİHTE HASTA RANDEVUSU YOK</p>
                        </div>
                        ";
                }
                while ($hasta = mysqli_fetch_array($sqluserdata)) {
                    echo "
                        <div class='panelilldiv'>
                            <p class='indexlabelinput'>Hasta ID: " . $hasta['hasta_id'] . " <b style='float: right;' class='indexlabelinput'>Tarih: " . $hasta['randevu_tarih'] . "</b></p>
                            <p class='indexlabelinput'>Adı ve Soyadı: " . $hasta['adsoyadi'] . "<b style='float: right;' class='indexlabelinput'>Saat: " . $hasta['randevu_saat'] . "</b></p>
                            <p class='indexlabelinput'>Telefon Numarası: " . $hasta['telno'] . "</p>
                            <p class='indexlabelinput'>Email: " . $hasta['email'] . " </p>
                            <p class='indexlabelinput'>Doktor Adı: " . $doctor_name . "<b style='float: right;'><a href='updateill.php?hasta_id=" . $hasta['hasta_id'] . "'><button class='panelbuttonupdate'>Güncelle</button></a></b></p>
                            <p class='indexlabelinput'>Hastanın Sorunu :" . $hasta['hasta_text'] . "<b style='float: right;'><a href='deleteill.php?hasta_id=" . $hasta['hasta_id'] . "&tarih=" . $hasta['randevu_tarih'] . "'><button class='panelbuttondelete'>SİL</button></a></b></p>
                        </div>
                        ";
                }
                ?>
            </div>
            <div class="paneldaterefresh">
                <div>
                    <a href="createill.php"><button class="inputbutton">RANDEVU OLUŞTUR</button></a><br><br>
                </div>
                <div class="paneldate">
                    <form method="POST" action="<?php $_PHP_SELF ?>">
                        <input type="date" class="paneldateinput" name="date" value="<?php echo $currentdate; ?>">
                        <button type="submit" class="panelbtdate">RANDEVULARI GETİR</button>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>