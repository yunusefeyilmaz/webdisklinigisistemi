<?php
//Veritabani baglanti
require_once "config.php";

//Doktor giris kontrol
session_start();
if (isset($_SESSION["login"])) {
    header('Location: ' . "doctorpanel.php");
}
//SELF POST ile giris dogru mu kontrol
if (isset($_POST["kullanici_adi"]) && isset($_POST["sifre"])) {
    $form_kullanici_adi = $_POST["kullanici_adi"];
    $form_sifre = $_POST["sifre"];

    //sifreyi sha256 ile aktarma
    $sifre_sha256 = hash("sha256", $form_sifre);

    $sql_login = mysqli_query($db, "SELECT * FROM doktorlar WHERE `doktor_kullaniciadi`='$form_kullanici_adi' AND `sifre`='$sifre_sha256'");
    $num = mysqli_num_rows($sql_login);

    //Boyle bir kullanici var mi kontrol
    if ($num == 0) {
        echo "Böyle bir doktor bulunamadı! Şifrenizi kontrol ediniz.";
    } else if ($num == 1) {
        //var ise panele yonlendirme
        $user = mysqli_fetch_assoc($sql_login);
        $_SESSION["login"] = $user["doktor_kullaniciadi"];
        header('Location: ' . "doctorpanel.php");
        exit;
    }
}
mysqli_close($db);
//giris ekrani
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel='stylesheet' href='site.css'>
    <title>DOKTOR GİRİŞİ</title>
</head>

<body class='bodylogin'>
    <div class='loginform'>
        <a href="index.php"><button class="backbutton">GERİ DÖN</button></a>
        <form action='<?php $_PHP_SELF ?>' method='POST'>
            <p class="loginheadlbl" style="text-align:center;margin-bottom:100px;">DOKTOR GİRİŞİ</p>
            <p class="indexlabelinput">Kullanıcı Adı</p>
            <input type='text' name='kullanici_adi' class="inputboxlogin"><br>
            <p class="indexlabelinput">Şifre</p>
            <input type='password' name='sifre' class="inputboxlogin"><br><br>
            <button class="inputbutton" type="submit">GİRİŞ YAP</button>
            <br>
            <br>
        </form>
    </div>
</body>

</html>