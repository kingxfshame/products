<?php
$servernimi = "localhost";
$kasutaja  = "root";
$parool = "";
$andmebaas = "products";
$connect = new mysqli($servernimi,$kasutaja,$parool,$andmebaas);
$connect-> set_charset("utf8");
?>
