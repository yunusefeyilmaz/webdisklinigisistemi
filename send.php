<!DOCTYPE html>
<html>

<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link rel="stylesheet" href="site.css" />
   <title>RANDEVU ALINDI</title>
</head>

<body class="sendbody">
   <div class="indexlogodiv">
      <img style="margin-left: 10em" src="images/dentistlogo.png" width="200px" height="200px" />
      <b class="logolbl">YILMAZ DİŞ KLİNİĞİ</b>
   </div>
   <?php
   //Veritabani baglanti
   require_once "config.php";
   //DOKTOR , HASTA  giris kontrol
   session_start();
   $doctor = false;
   if (isset($_SESSION["login"])) {
      $doctor = true;
   }
   //Self POST degerleri
   if (
      isset($_POST["hasta_adi"]) && isset($_POST["email"])
      && isset($_POST["telno"]) && isset($_POST["hasta_text"])
      && isset($_POST["doktor_id"]) && isset($_POST["tarih"])
      && isset($_POST["saat"])
   ) {
      $r_hasta_adi = $_POST["hasta_adi"];
      $r_email = $_POST["email"];
      $r_telno = $_POST["telno"];
      $r_hasta_text = $_POST["hasta_text"];
      $r_doktor_id = $_POST["doktor_id"];
      $r_tarih = $_POST["tarih"];
      $r_saat = $_POST["saat"];

      //MySQL hasta olusturma komutu
      //Hastanin verilerinin veritabanina aktarilmasi
      $createsql = "INSERT INTO `hastalar`" .
         "(adsoyadi,email,telno,doktor_id,randevu_tarih,randevu_saat,hasta_text)" .
         "VALUES('$r_hasta_adi','$r_email','$r_telno','$r_doktor_id','$r_tarih','$r_saat','$r_hasta_text')";
      //Hastanin doktorunun adi SQL komutu
      $doctornamesql = "SELECT doktor_adsoyadi FROM `doktorlar` WHERE doktor_id='" . $r_doktor_id . "'";
      $doctornamerequest = mysqli_query($db, $doctornamesql);
      $doctor_name = mysqli_fetch_array($doctornamerequest)["doktor_adsoyadi"];
      //Olusturma basarili mi?
      $sqlrequest = mysqli_query($db, $createsql);
      if (!$sqlrequest) {
         echo '<br>Hata:' . mysqli_error($db);
      } else {
         //Doktor kendi eklemisse
         if ($doctor) {
            $doctor_username = $_SESSION["login"];
            $sqldoctordataquery = "SELECT * FROM `doktorlar` WHERE doktor_kullaniciadi='" . $doctor_username . "'";
            $sqldoctordata = mysqli_query($db, $sqldoctordataquery);
            if (!$sqldoctordata) {
               echo '<br>Doktor Verileri Alınamadi:' .
                  mysqli_error($db);
            }
            //Doktor bilgileri
            $doctordata = mysqli_fetch_array($sqldoctordata);
            $doctor_name = $doctordata["doktor_adsoyadi"];
            $doctor_title = $doctordata["unvan"];
            ?>
            <!-- DOKTOR -->
            <p class="indexlabelinput">
               <?php echo $doctor_title . " " . $doctor_name; ?> tarafından
               <?php echo $r_hasta_adi; ?> kişisinin randevusu
               başarılı bir şekilde oluşturulmuştur.
            </p><br>
            <form action='doctorpanel.php' method='POST'>
               <input type='hidden' name='date' value='<?php echo $r_tarih; ?>'>
               <button class="backbutton">GERİ DÖN</button>
            </form>
            <?php
         } else {
            ?>
            <!-- HASTA -->
            <p class="indexlabelinput">
               <?php echo $r_hasta_adi . " randevunuz başarılı bir şekilde oluşturmuştur.<br>" . $r_tarih . " tarihinde " . $r_saat . " saatinde kliğinimize gelebilirsiniz.<br>Doktorunuz " . $doctor_name . " sizi " . $r_telno . " telefonunuz veya " . $r_email . " mailiniz üzerinden sizi bilgilendirecektir.<br>
BİZİ SEÇTİĞİNİZ İÇİN TEŞEKKÜRLER." ?>
            </p><br>
            <a href="index.php"><button class="backbutton">GERİ DÖN</button></a>
            <?php
         }
      }
   } else {
      header('Location: ' . "index.php");
      exit;
   }
   mysqli_close($db);
   ?>
</body>

</html>