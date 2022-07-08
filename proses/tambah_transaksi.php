<?php

session_start();
require '../koneksi.php';
require '../item.php';

//Simpan pesanan baru
// $sql1 = 'INSERT INTO orders (name, datecreation, status, username) VALUES ("New Order","'.date('Y-m-d').'",0,"acc2")';
// mysqli_query($con, $sql1);
// $ordersid = mysqli_insert_id($con);

$id_user = $_SESSION['id_user']; //Mengambil id_user

$cart = unserialize(serialize($_SESSION['cart'])); //Set $cart sebagai array, serialize () mengubah string menjadi array

$status = 1;

for ($i=0; $i<count($cart);$i++) {

    $subtotal = $cart[$i]->HargaPrinter * $cart[$i]->Jumlah;
    $sql2 = 'INSERT INTO transaksi (Jumlah, UserIdUser, status, Printer_tbIdPrinter, UserIdUser2) VALUES ('.$subtotal.', '.$id_user.', '.$status.', '.$cart[$i]->IdPrinter.', '.$id_user.')';
    mysqli_query($koneksi, $sql2);

}

//Menghapus semua produk dalam keranjang
unset($_SESSION['cart']); //Unset sesi cart
header('Location: ../orders.php');
// header('Location: ../index.php#product'); //Dialokasikan ke halaman cart.php

?>