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
    <title>E-Commerce</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="icon" href="img/login.svg">
</head>
<body>

    <?php 
        if (isset($_SESSION["Username"])) {
        
            if ($_SESSION["Username"] == "") {
                
            } else if ($_SESSION["Username"] == "admin") {  
                header('Location:admin/dashboard.php');
            }
        }
    ?>

    <!-- Navigasi -->
    <header id="desktop">
        <ul>
            <li><img src="img/login.svg" width="40px" alt="Logo"></li>
            <li><a href="">Home</a></li>
            <li><a href="#product">Product</a></li>
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

            <!-- Cek Session, jika admin maka akan tampil link dashboard -->
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
                                <a href="orders.php">Transaksi</a>
                            </li>
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
                            <li>
                                <a href="register.php">Register</a>
                            </li>
                        ';
                }
            ?>
            
        </ul>
    </header>

    <header id="mobile">
        <ul>
            <li><img src="img/login.svg" width="40px" alt="Logo"></li>
        </ul>
        <ul>
            <li><a href="login.php">Login</a></li>
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
            <!-- <li><a href="cart.php?index=">Cart</a></li> -->
        </ul>
    </header>

    <!-- Hero -->
    <div class="hero">
        <h1>Welcome!</h1>
        <p>kami menyediakan berbagai macam barang elektronik khusus PC<br>Dengan Harga yang terjangkau</p>
        <a href="#product"><button>Lihat Produk</button></a>
    </div>

    <!-- Post -->
    <div class="container" id="product">
        <h2>Product</h2>
        <section>
        <!-- Perulangan untuk menampilkan data product dari database -->
        <?php

            $query = "SELECT * FROM printer_tb ORDER BY IdPrinter DESC";
            $result = mysqli_query($koneksi, $query);

            while ($printer = mysqli_fetch_array($result)) { ?>
                <div class='card'>
                    <div class="box">
                        <img src='img/post/<?= $printer['image']; ?>' alt='Produk' style='width: 200px'>
                    </div>
                    <!-- <img src='img/post/ram.svg' alt='Produk' style='width: 200px'> -->
                    <div class='body-card'>
                        <h4><?= $printer['NamaPrinter']; ?></h4>
                        <p><?= $printer['SpesifikasiPrinter']; ?></p>
                        <p>Stok: <?= $printer['stok']; ?></p>
                        <p><?= "Rp. " . number_format($printer['HargaPrinter'], 0, ".", "."); ?></p>
                        <a href="cart.php?id=<?= $printer['IdPrinter']; ?>"><button>+ Cart</button></a>
                     </div>
                </div>
        <?php } ?>
        </section>
    </div>

    <!-- Footer -->
    <div class="container footer" id="contact">
        <p>&copy; Copyright 2022 - Adityawarman Dewa Putra&nbsp;&nbsp; | &nbsp;&nbsp;Contact: dewagaming123.sp@gmail.com</p>
    </div>

</body>
</html>