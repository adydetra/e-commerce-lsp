<?php 

//Sesi
session_start();

//Include Koneksi
include_once('../koneksi.php');

//Mengambil ID
$id = $_GET["id"];

//Mumutuskan Sesi
unset($_SESSION["cart"][$id]);

//Dialokasikan ke halaman cart.php
header("location:../cart.php");

?>