<?php
    include_once("../koneksi.php"); //Koneksi
    
    $IdPrinter = $_GET['IdPrinter']; //Mengambil IdPrinter
    
    $result = mysqli_query($koneksi, "DELETE FROM printer_tb WHERE IdPrinter=$IdPrinter"); //Menghapus data dari tabel printer_tb berdasarkan IdPrinteer
    
    header("Location:dashboard.php"); //Dialokasikan ke halaman admin.php
?>