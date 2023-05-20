<?php

//Doktor girisi kontrol
session_start();
if (!isset($_SESSION["login"])) {
    header('Location: ' . "index.php");
    exit;
}
//Veritabani baglanti
require_once "config.php";

//SELF POST doktor verileri kontrol
if (isset($_POST["doktor_adi"]) && isset($_POST["unvan"]) && isset($_POST["password"]) && isset($_POST["doktor_kullaniciadi"])) {


    $r_kullaniciadi = $_POST["doktor_kullaniciadi"];
    $r_doktoradi = $_POST["doktor_adi"];
    $r_doktorunvan = $_POST["unvan"];
    $r_doktorpassword = $_POST["password"];
    //SHA256 ile şifreleme
    $r_sha256_password = hash("sha256", $r_doktorpassword);

    //MySQL doktor olusturma komutu
    //Doktorun verilerinin veritabanina aktarilmasi
    $createsql = "INSERT INTO `doktorlar`" .
        "(doktor_kullaniciadi,doktor_adsoyadi,sifre,unvan)" .
        "VALUES('$r_kullaniciadi','$r_doktoradi','$r_sha256_password','$r_doktorunvan')";

    //Olusturma basarili mi?
    $sqlrequest = mysqli_query($db, $createsql);
    if (!$sqlrequest) {
        echo '<br><p class="loginheadlbl">Hata:Doktor oluşturulamadi.</p>';
    } else {
        echo "<p class='loginheadlbl'>Doktor başarılı bir şekilde oluşturuldu.</p>";
    }
}

mysqli_close($db);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel='stylesheet' href='site.css'>
    <title>DOKTOR OLUŞTUR</title>
</head>

<body class="indexbody">
    <div class="formdiv">
        <div class="form">
            <a href="doctorpanel.php"><button class="backbutton">GERİ DÖN</button></a>
            <form action="createdoctor.php" method="POST">
                <b class="indexlabelinput">Doktor Kullanıcı Adı</b><br>
                <input type="text" name="doktor_kullaniciadi" pattern="[a-z]+[a-z0-9]*" placeholder="Örn: ahmetyilmaz"
                    title="Lütfen boşluksuz ve küçük harf kullanarak bir kullanıcı adı yazın." class="inputbox"
                    required><br>
                <b class="indexlabelinput">Doktor Adı ve Soyadı</b><br>
                <input type="text" name="doktor_adi" placeholder="Örn: Ahmet Yılmaz" class="inputbox" required><br>
                <b class="indexlabelinput">Doktor Unvanı</b><br>
                <input type="text" name="unvan" placeholder="Örn:Yardımcı Doktor" class="inputbox" required><br>
                <b class="indexlabelinput">Doktor Sifresi</b><br>
                <input type="password" name="password" class="inputbox" required><br>
                <button class="inputbutton">DOKTOR OLUŞTUR</button>
            </form>
        </div>
    </div>
</body>

</html>