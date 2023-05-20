<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel='stylesheet' href='site.css'>
    <title>HASTA SİL</title>
</head>

<body class="panellogodiv">

    <?php
    //Doktor giris kontrol
    session_start();
    if (!isset($_SESSION["login"])) {
        header('Location: ' . "index.php");
        exit;
    }
    //Veri tabani baglanti
    require_once "config.php";
    //GET ile hasta_id si kontrol
    if (!isset($_GET["hasta_id"])) {
        header('Location: ' . "doctorpanel.php");
        exit;
    }
    //GET ile delete komutu gelmis mi kontrol
    if (isset($_GET["delete"])) {
        if ($_GET["delete"] = "true") {
            //MySQL delete komutu id ye gore
            $sql = "DELETE FROM `hastalar` WHERE `hasta_id`=" . $_GET["hasta_id"];
            $sqldelete = mysqli_query($db, $sql);
            //Silme basarili mi?
            if (!$sqldelete) {
                echo '<br>Hata:' . mysqli_error($db);
            } else {
                echo "<p class='indexlabelinput'>Kayıt Silindi!</p><br>";
                echo "<form action='doctorpanel.php' method='POST'>
                <input type='hidden' name='date' value='" . $_GET["tarih"] . "'>
                <button class='panelbuttonupdate'>GERİ DÖN</button></form>";
                die();
            }
        }
    }
    mysqli_close($db);
    ?>
    <div style="text-align:center;justify-content:center;align-items: center;">
        <form action='deleteill.php' method='GET'>
            <p class="indexlabelinput">Hasta ID:
                <?php echo $_GET["hasta_id"]; ?> olan hastayı silmek üzeresiniz. Onaylıyor musunuz?
            </p>
            <br>
            <input type='hidden' name='hasta_id' value='<?php echo $_GET["hasta_id"]; ?>'>
            <input type='hidden' name='tarih' value='<?php echo $_GET["tarih"]; ?>'>
            <input type='hidden' name='delete' value='true'>
            <button type='submit' class="panelbuttondelete">EVET</button>
        </form>
        <form action='doctorpanel.php' method='POST'>
            <input type='hidden' name='date' value='<?php echo $_GET["tarih"]; ?>'>
            <button class="panelbuttonupdate">GERİ DÖN</button>
        </form>
    </div>
</body>

</html>