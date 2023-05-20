<?php
session_start();
session_destroy();
echo "Session sonlandırıldı.";
header('Location: ' . "index.php");