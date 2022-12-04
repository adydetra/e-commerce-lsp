<?php

session_start();

include_once("koneksi.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="css/orders.css">
    <link rel="icon" href="img/login.svg">
</head>
<body>

    <!-- Navigasi -->
    <header>
        <ul>
            <li><img src="img/login.svg" width="40px" alt="Logo"></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#product">Product</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <ul>
            <?php 
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                    $cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
                    echo'<li><a href="cart.php">Cart</a></li>';
                }
                else {
                    echo'<li><a href="cart.php?index=">Cart</a></li>';
                    // exit('Produk Tidak ada di Keranjang!');
                }
            ?>

            <?php
                if (isset($_SESSION['Username'])) {
                    if ($_SESSION['Username'] == 'admin') {
                        echo '
                            <li>
                                <a href="admin/dashboard.php">Dashboard</a>
                            </li>
                        ';
                    } else {
                        echo '
                            <li>
                                <a href="admin/logout.php" class="logout">Logout</a>
                            </li>
                        ';
                    }
                } else {
                    echo '
                            <li>
                                <a href="login.php">Login</a>
                            </li>
                        ';
                }
            ?>
        </ul>
    </header>

    <div class="container">

    <?php

    if (isset($_SESSION["Username"])) {
        
        if ($_SESSION["Username"] == "") {
            
        } else if ($_SESSION["Username"] == "admin") {  
            header('Location:admin/dashboard.php');
        }
    }

    if($_SESSION['status']!="login"){
        header("location:index.php?pesan=Silahkan-Login-Terlebih-Dahulu");
    }
    
    ?>

    <!-- Post -->
    <div class="container" id="order">
        <h2 class="red">Belum Dikonfirmasi</h2>
        <section>

                <table border="1" cellpadding="3">
                    <tr>
                        <th> No </th>
                        <!-- <th> Id Transaksi </th> -->
                        <th> Nama Printer </th>
                        <th> Total Harga </th>
                        <th> Status </th>
                        <th> Opsi </th>
                    </tr>

                    <!-- Belum dikonfirmasi -->
                    <?php

                    //Koneksi
                    include ("koneksi.php");

                    $id = $_SESSION['id_user']; //Id User
                    $query = "SELECT * FROM transaksi
                    JOIN printer_tb ON printer_tb.IdPrinter = Printer_tbIdPrinter"; //Mengambil data dari tabel transaksi
                    $result = mysqli_query($koneksi, $query);
                    $no= 1;
                    $total = 0;

                    //Perulangan
                    while ($transaksi = mysqli_fetch_object($result)) { if ($transaksi->status == 1) { ?>
                    
                        <tr>
                            <td class="text-center"><?= $no++ ?>.</td>
                            <!-- <td class="text-center"><?= $transaksi->IdTransaksi ?></td> -->
                            <td><?= $transaksi->NamaPrinter ?></td>
                            <td><?= "Rp. " . number_format($transaksi->Jumlah, 0, ".", "."); ?></td>
                            <td class="red">Belum Dikonfirmasi</td>
                            <td> <!-- Untuk Menghapus orderan -->
                                <a href="proses/hapus_orders.php?IdTransaksi=<?= $transaksi->IdTransaksi ?>" onclick="return confirm('Yakin Hapus?')">Batal Order</a>
                            </td>
                        </tr>
                    <?php } } ?>
            </table>
            <br><br>
            <h2 class="green">Sudah Dikonfirmasi</h2>
            <table border="1" cellpadding="3">
                <tr>
                    <th> No </th>
                    <!-- <th> Id Transaksi </th> -->
                    <th> Nama Printer </th>
                    <th> Total Harga </th>
                    <th> Status </th>
                    <th> Opsi </th>
                </tr>

                <!-- Sudah dikonfirmasi -->
                <?php

                $id = $_SESSION['id_user'];
                $query = "SELECT * FROM transaksi
                JOIN printer_tb ON printer_tb.IdPrinter = Printer_tbIdPrinter"; //Mengambil data dari tabel transaksi
                $result = mysqli_query($koneksi, $query);
                $no= 1;
                $total = 0;

                while ($transaksi = mysqli_fetch_object($result)) { if ($transaksi->status == 2) { ?>

                <tr>
                    <td class="text-center"><?= $no++ ?>.</td>
                    <!-- <td class="text-center"><?= $transaksi->IdTransaksi ?></td> -->
                    <td><?= $transaksi->NamaPrinter ?></td>
                    <td><?= "Rp. " . number_format($transaksi->Jumlah, 0, ".", "."); ?></td>
                    <td class="green">Sudah Dikonfirmasi</td>
                    <td>
                        <a href="proses/hapus_orders.php?IdTransaksi=<?= $transaksi->IdTransaksi ?>" onclick="return confirm('Yakin Hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } } ?>

            </table>

        </section>
    </div>

    <!-- Footer -->
    <div class="container footer" id="contact">
        <p>&copy; Copyright 2022 - Adityawarman Dewa Putra&nbsp;&nbsp; | &nbsp;&nbsp;Contact: devdewa123.sp@gmail.com</p>
    </div>

</body>
</html>