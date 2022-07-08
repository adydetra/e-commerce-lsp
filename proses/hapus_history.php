<?php 
    
    //Include Koneksi
    include_once('../koneksi.php');

    //Mengambil ID transaksi
    $IdTransaksi = $_GET['IdTransaksi'];
    
    $hasil = mysqli_query($koneksi, "DELETE FROM transaksi WHERE IdTransaksi=$IdTransaksi");
    
    //Dialokasikan ke halaman history.php
    header("Location:../admin/page/history.php");
    
?>