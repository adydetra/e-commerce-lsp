<?php 

include_once("../koneksi.php"); //Koneksi

$IdTransaksi = $_GET['IdTransaksi']; //Mengambil IdTransaksi
 
$result = mysqli_query($koneksi, "DELETE FROM transaksi WHERE IdTransaksi=$IdTransaksi");

header("Location:../orders.php"); //Dialokasikan ke halaman orders.php

?>