<?php
header('Content-type: text/html; charset=utf-8');
//DOKTOR giris kontrol
session_start();
if (!isset($_SESSION["login"])) {
    header('Location: ' . "index.php");
    exit;
}
//Veritabani baglanti
require_once "config.php";

//Guncellenecek hasta id si GET ile alinmasi
if (!isset($_GET["hasta_id"])) {
    header('Location: ' . "doctorpanel.php");
    exit;
}

//SELF POST ile hasta guncelleme
if (isset($_POST["hasta_adi"])) {
    $hasta_adi = $_POST['hasta_adi'];
    $hasta_email = $_POST['email'];
    $hasta_telno = $_POST['telno'];
    $hasta_text = $_POST['hasta_text'];
    $hasta_doktor = $_POST['doktor_id'];
    $hasta_tarih = $_POST['tarih'];
    $hasta_saat = $_POST['saat'];

    //MySQL hasta guncelleme komutu
    $sql = "UPDATE `hastalar` SET adsoyadi='$hasta_adi',email='$hasta_email',telno='$hasta_telno',
    hasta_text='$hasta_text',doktor_id='$hasta_doktor',randevu_tarih='$hasta_tarih',randevu_saat='$hasta_saat'
    WHERE hasta_id='" . $_GET['hasta_id'] . "'";

    //Guncelleme basarili mi?
    $sqlupdate = mysqli_query($db, $sql);
    if (!$sqlupdate) {
        echo "<p class='loginheadlbl'>Kayıt Güncellenemedi</p>";
    } else {
        echo "<p class='loginheadlbl'>Kayıt Güncellendi.</p>";
    }
}

//Doktor Verileri alma
$sqldoctordataquery = "SELECT doktor_id,doktor_adsoyadi FROM `doktorlar`";
$sqldoctordata = mysqli_query($db, $sqldoctordataquery);
if (!$sqldoctordata) {
    echo '<br>Doktor Verileri Alınamadi:';
}

//Hasta verilerinin veritabanindan alinmasi
$sql = "SELECT * FROM `hastalar` WHERE `hasta_id`='" . $_GET["hasta_id"] . "'";
$sqluserdata = mysqli_query($db, $sql);
if (!$sqluserdata) {
    echo '<br>Hasta Verileri Alınamadi:';
}
//Hasta verilerinin ekrana yazdirilmasi
$hasta = mysqli_fetch_array($sqluserdata);
$hasta_adi = $hasta['adsoyadi'];
$hasta_email = $hasta['email'];
$hasta_telno = $hasta['telno'];
$hasta_text = $hasta['hasta_text'];
$hasta_doktor = $hasta['doktor_id'];
$hasta_tarih = $hasta['randevu_tarih'];
$hasta_saat = $hasta['randevu_saat'];
mysqli_close($db);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel='stylesheet' href='site.css'>
    <title>HASTA GUNCELLEME</title>
</head>

<body>
    <div class="formdiv">
        <div class="form">
            <form action='doctorpanel.php' method='POST'>
                <input type='hidden' name='date' value='<?php echo $hasta_tarih; ?>'>
                <button class="backbutton">GERİ DÖN</button>
            </form>
            <form action="<?php $_PHP_SELF ?>" method="POST">
                <b class="indexlabelinput">Adınız ve Soyadınız</b><br>
                <input type="text" name="hasta_adi" class="inputbox" value='<?php echo $hasta_adi; ?>' required><br>
                <b class="indexlabelinput">Email</b><br>
                <input type="email" name="email" class="inputbox" value="<?php echo $hasta_email; ?>" required><br>
                <b class="indexlabelinput">Telefon Numarası</b><br>
                <input type="tel" name="telno" class="inputbox" placeholder="05XXXXXXXXX" pattern="^\05\d{9}$"
                    title="Lütfen geçerli bir Türkiye telefon numarası girin. Örnek: 05551234567"" value="<?php echo $hasta_telno; ?>" required><br>
                <b class="indexlabelinput">Sorununuzu Yazınız:</b><br>
                <textarea name="hasta_text" placeholder="Örn: Diş Çekimi" class="indexboxarea"
                    required><?php echo $hasta_text; ?></textarea><br>
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
                <input type="date" name="tarih" class="inputbox" value="<?php echo $hasta_tarih; ?>" required><br>
                <b class="indexlabelinput">Randevu Saati</b><br>
                <input type="time" name="saat" class="inputbox" value="<?php echo $hasta_saat; ?>" required><br>
                <button class="inputbutton">RANDEVUYU GÜNCELLE</button>
            </form>
        </div>
    </div>
</body>

</html>