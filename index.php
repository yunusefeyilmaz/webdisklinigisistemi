<?php
require_once "config.php";
$sqldoctordataquery = "SELECT doktor_id,doktor_adsoyadi FROM `doktorlar`";
$sqldoctordata = mysqli_query($db, $sqldoctordataquery);
if (!$sqldoctordata) {
  echo '<br>Doktor Verileri Alınamadi:';
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="site.css" />
  <title>YILMAZ DİŞ KLİNİĞİ</title>
</head>

<body class="indexbody">
  <div>
    <div class="indexhead">
      <div class="indexlogodiv">
        <img style="margin-left: 10em" src="images/dentistlogo.png" width="200px" height="200px" />
        <b class="logolbl">YILMAZ DİŞ KLİNİĞİ</b>
      </div>
      <a href="login.php"><button class="logindoctorbt">Doktor Girişi</button></a>
    </div>
    <br />
    <div>
      <p class="lblWelcome">HOŞGELDİNİZ,</p>
      <p class="lblWelcomeunder">
        Aşağıdaki formu doldurarak online randevu alabilirsiniz.
      </p>
    </div>
    <div class="formdiv">
      <div class="form">
        <form action="send.php" method="POST">
          <b class="indexlabelinput">Adınız ve Soyadınız</b><br />
          <input type="text" name="hasta_adi" placeholder="Örn: Ahmet Yılmaz" class="inputbox" required /><br />
          <b class="indexlabelinput">Email</b><br />
          <input type="email" name="email" placeholder="Örn:abc@abc.com" class="inputbox" required /><br />
          <b class="indexlabelinput">Telefon Numarası</b><br />
          <input type="tel" name="telno" class="inputbox" placeholder="05XXXXXXXXX" pattern="^\05\d{9}$"
            title="Lütfen geçerli bir Türkiye telefon numarası girin. Örnek: 05551234567" required /><br />
          <b class="indexlabelinput">Sorununuzu Yazınız</b><br />
          <textarea name="hasta_text" placeholder="Örn: Diş Çekimi" class="indexboxarea" required></textarea><br />
          <b class="indexlabelinput">Doktor Seçiniz</b><br />
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
          <br />
          <b class="indexlabelinput">Randevu Tarihi</b><br />
          <input type="date" name="tarih" class="inputbox" required /><br />
          <b class="indexlabelinput">Randevu Saati</b><br />
          <input type="time" name="saat" class="inputbox" required /><br />
          <button class="inputbutton">RANDEVU OLUŞTUR</button>
        </form>
      </div>
    </div>
    <div class="indexfoot">
      <p>
        Bu site Web Tabanlı Programlama dersinin ödevi için
        hazırlanmıştır.Sitedeki verilerin hiçbiri gerçeği yansıtmamaktadır.
      </p>
      <a href="https://github.com/yunusefeyilmaz/webdisklinigisistemi">
        <p>
          Buraya tıklayarak github üzerindeki kaynak kodlara ulaşabilirsiniz.
        </p>
      </a>
    </div>
    <div class="indexfoot">
      <a href="https://github.com/yunusefeyilmaz/webdisklinigisistemi"><img
          src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" width="75px"
          height="75px" /></a>
    </div>
  </div>
</body>

</html>