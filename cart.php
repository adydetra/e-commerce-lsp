<?php

session_start (); //Sesi
require 'koneksi.php'; //Koneksi
require 'item.php'; //Item

if (isset ( $_GET ['id'] ) && !isset($_POST['update'])) {

	$result = mysqli_query ( $koneksi, 'SELECT * FROM printer_tb WHERE IdPrinter=' . $_GET ['id'] );
	$product = mysqli_fetch_object ( $result );
	$item = new Item ();
	$item->IdPrinter = $product->IdPrinter;
	$item->NamaPrinter = $product->NamaPrinter;
    $item->SpesifikasiPrinter = $product->SpesifikasiPrinter;
	$item->HargaPrinter = $product->HargaPrinter;
    $item->stok = $product->stok;
    $item->image = $product->image;
	$item->Jumlah = 1;
    
	// Check produk
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check produk sudah ada di keranjang
	$index = - 1;
	if (isset ( $_SESSION ['cart'] )) {
		$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
		for($i = 0; $i < count ( $cart ); $i ++)
		if ($cart [$i]->IdPrinter == $_GET ['id']) {
			$index = $i;
			break;
		}
	}
	if ($index == - 1)
	$_SESSION ['cart'] [] = $item;
	else {
		$cart [$index]->Jumlah ++;
		$_SESSION ['cart'] = $cart;
	}
}

// Delete Produk
if (isset ( $_GET ['index'] ) && !isset($_POST['update'])) {
	$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
	unset ( $cart [$_GET ['index']] );
	$cart = array_values ( $cart );
	$_SESSION ['cart'] = $cart;
}

// Update Jumlah Cart
if(isset($_POST['update'])) {
	$arrJumlah = $_POST['Jumlah'];

	// Check validate Jumlah
	$valid = 1;
	for($i=0; $i<count($arrJumlah); $i++)
	if(!is_numeric($arrJumlah[$i]) || $arrJumlah[$i] < 1){
		$valid = 0;
		break;
	}
	if($valid==1){
		$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
		for($i = 0; $i < count ( $cart ); $i ++) {
			$cart[$i]->Jumlah = $arrJumlah[$i];
		}
		$_SESSION ['cart'] = $cart;
	}
	else
		$error = 'Jumlah is InValid';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/cart.css">
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
                        ';
                }
            ?>
        </ul>
    </header>

    <div class="container">
    <!-- Cek Session, jika sebagai admin, Maka script akan dimatikan dan muncul sebuah pesan "Anda bukan User" -->
    <?php

    if (isset($_SESSION["Username"])) {
        
        if ($_SESSION["Username"] == "") {
            
        } else if ($_SESSION["Username"] == "admin") {  
            header('Location:admin/dashboard.php');
        }
    }
    
    if($_SESSION['status']!="login"){
        header("location:login.php?pesan=Silahkan-Login-Terlebih-Dahulu"); //Cek Session, jika blm login akan diarahkan ke login.php
    }

    ?>

        <form method="post">
            <table border="1" cellpadding="3">
                <tr>
                    <th> No </th>
                    <th> Gambar </th>
                    <th> Nama Barang </th>
                    <th> Spesifikasi </th>
                    <th> Harga </th>
                    <th> Jumlah </th>
                    <th> Total </th>
                    <th> Opsi </th>
                </tr>
                <?php
               
                $no= 1;
                $subtotal = 0;
                $index = 0;

                if (isset($_GET['id'])) {
                    $cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
                }
                else {
                    // die("Produk tidak ada di keranjang!");
                    // exit('Produk Tidak ada di Keranjang!');
                }

                for($i = 0; $i < count ( $cart ); $i ++) {
                    $subtotal += $cart [$i]->HargaPrinter * $cart [$i]->Jumlah;
                    ?>
                <tr>
                    <td><?php echo $no++; ?>.</td>
                    <td><img src="img/post/<?php echo $cart[$i]->image; ?>" width="80px"></td>
                    <td><?php echo $cart[$i]->NamaPrinter; ?></td>
                    <td><?php echo $cart[$i]->SpesifikasiPrinter; ?></td>
                    <td><?= "Rp. " . number_format($cart[$i]->HargaPrinter, 0, ".", "."); ?></td>
                    <td>
                        <input type="number" value="<?php echo $cart[$i]->Jumlah; ?>" min="1" max="<?php echo $cart[$i]->stok; ?>" name="Jumlah[]">
                    </td>
           
                    <td><?= "Rp. " . number_format($cart[$i]->HargaPrinter * $cart[$i]->Jumlah, 0, ".", "."); ?></td>
                    <td><a href="cart.php?index=<?php echo $index; ?>"
                        onclick="return confirm('Kamu Yakin?')">Delete</a></td>
                </tr>
                <?php
                $index ++;
                }
                ?>
                <tr>
                    <th colspan="6" align="right">GRAND TOTAL</th>
                    <th align="left"><?= "Rp. " . number_format($subtotal, 0, ".", "."); ?></th>
                    <th id="save">
                        <input type="image" src="img/save.svg"> 
                        <input type="hidden" name="update">  
                    </th>
                </tr>
            </table>
        </form>

        <a id="beli" href="proses/tambah_transaksi.php">Checkout</a>
    </div>

    <!-- Footer -->
    <div class="container footer" id="contact">
        <p>&copy; Copyright 2022 - Adityawarman Dewa Putra&nbsp;&nbsp; | &nbsp;&nbsp;Contact: dewagaming123.sp@gmail.com</p>
    </div>

</body>
</html>