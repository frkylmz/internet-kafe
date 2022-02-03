<?php
error_reporting(0);
try {
    $db_host    = 'localhost';
    $db_adi     = 'internet_kafe'; 
    $db_kul     = 'root';
    $db_sifre   = ''; 
    $charset    = 'utf8'; 

    $conn = new PDO("mysql:host=$db_host;dbname=$db_adi;charset=$charset", $db_kul, $db_sifre);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("SET NAMES utf8"); 
    $conn->query("SET CHARACTER SET utf8");
    $conn->query("SET COLLATION_CONNECTION = \"utf8_turkish_ci\"");
    $conn->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
    
} catch (PDOException $e) {
    echo 'Bağlantı Hatası: ' . $e->getMessage();
}
?>
