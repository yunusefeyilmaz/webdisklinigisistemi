<?php
header('Content-type: text/html; charset=utf-8');
//Doktor girisi kontrol
session_start();
if (!isset($_SESSION["login"])) {
    header('Location: ' . "index.php");
    exit;
}
//Veritabani baglanti
require_once "config.php";
$sqldoctordataquery = "SELECT doktor_id,doktor_adsoyadi FROM `doktorlar`";
$sqldoctordata = mysqli_query($db, $sqldoctordataquery);
if (!$sqldoctordata) {
    echo '<br>Doktor Verileri Alınamadi:';
}
mysqli_close($db);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel='stylesheet' href='site.css'>
    <title>HASTA OLUŞTUR</title>
</head>

<body class="indexbody">
    <div class="formdiv">
        <div class="form">
            <a href="doctorpanel.php"><button class="backbutton">GERİ DÖN</button></a>
            <form action="send.php" method="POST">
                <b class="indexlabelinput">Adınız ve Soyadınız</b><br>
                <input type="text" name="hasta_adi" placeholder="Örn: Ahmet Yılmaz" class="inputbox" required><br>
                <b class="indexlabelinput">Email</b><br>
                <input type="email" name="email" placeholder="Örn:abc@abc.com" class="inputbox" required><br>
                <b class="indexlabelinput">Telefon Numarası</b><br>
                <input type="tel" name="telno" class="inputbox" placeholder="05XXXXXXXXX" pattern="^\05\d{9}$"
                    title="Lütfen geçerli bir Türkiye telefon numarası girin. Örnek: 05551234567"" required><br>
                    <b class=" indexlabelinput">Sorununuzu Yazınız</b><br>
                <textarea name="hasta_text" placeholder="Örn: Diş Çekimi" class="indexboxarea" required></textarea><br>
                <b class="indexlabelinput">Doktor Seçiniz</b><br>
                <select name="doktor_id" id="doktor_id" class="inputbox" required>
                    <optgroup label="Doktorlar">
                        <?php
                        //Doktor bilgileri
                        while ($doctordata = mysqli_fetch_array($sqldoctordata)) {
                            echo "<option value=" . $doctordata["doktor_id"] . ">" . $doctordata["doktor_adsoyadi"] . "</option>";
                        }
                        mysqli_close($db);
                        ?>
                    </optgroup>
                </select>
                <br>
                <b class="indexlabelinput">Randevu Tarihi</b><br>
                <input type="date" name="tarih" class="inputbox" required><br>
                <b class="indexlabelinput">Randevu Saati</b><br>
                <input type="time" name="saat" class="inputbox" required><br>
                <button class="inputbutton">RANDEVU OLUŞTUR</button>
            </form>
        </div>
    </div>
</body>

</html>