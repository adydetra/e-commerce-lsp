<?php 
    session_start(); //Sesi dimulai atau diaktifkan
    
    session_destroy(); //Sesi dihancurkan atau dimatikan
    
    header("location:../index.php"); //Dialokasikan ke halaman ../index.php
?>