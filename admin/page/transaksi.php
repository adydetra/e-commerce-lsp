<?php 
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Transaksi</title>
    
    <link rel="stylesheet" href="../../css/admin.css" type="text/css">
	<link rel="icon" href="../../img/login.svg">
</head>
<body>

	<?php 
        session_start();
        include_once("../../koneksi.php"); //Koneksi

        $result = mysqli_query($koneksi, "SELECT * FROM printer_tb ORDER BY IdPrinter DESC"); //Mengambil data produk atau printer_tb
        $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi
    	JOIN printer_tb ON printer_tb.IdPrinter = transaksi.Printer_tbIdPrinter"); //Mengambil data transaksi

        if($_SESSION['status']!="login"){ //Cek Session
            header("location:../../index.php?pesan=Silahkan-Login-Terlebih-Dahulu");
        }

        if($_SESSION['Username']!="admin"){ //Cek Session
            die("Anda bukan Admin");
        }

    ?>

    <div class="dashboard">
	
	<header class="menu-wrap">
		<figure class="user">
			<div class="user-avatar">
				<img src="../../img/login.svg" alt="Admin">
			</div>
			<figcaption>
				Admin
			</figcaption>
		</figure>
	
		<nav>
			<section class="dicover">
				<h3>Umum</h3>
				
				<ul>
					<li>
						<a href="../dashboard.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6.855 14.365l-1.817 6.36a1.001 1.001 0 0 0 1.517 1.106L12 18.202l5.445 3.63a1 1 0 0 0 1.517-1.106l-1.817-6.36 4.48-3.584a1.001 1.001 0 0 0-.461-1.767l-5.497-.916-2.772-5.545c-.34-.678-1.449-.678-1.789 0L8.333 8.098l-5.497.916a1 1 0 0 0-.461 1.767l4.48 3.584zm2.309-4.379c.315-.053.587-.253.73-.539L12 5.236l2.105 4.211c.144.286.415.486.73.539l3.79.632-3.251 2.601a1.003 1.003 0 0 0-.337 1.056l1.253 4.385-3.736-2.491a1 1 0 0 0-1.109-.001l-3.736 2.491 1.253-4.385a1.002 1.002 0 0 0-.337-1.056l-3.251-2.601 3.79-.631z"/></svg>
							Dashboard
						</a>
					</li>
					
					<li>
						<a href="produk.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.353 2.355-6.049-.002-8.416zm-1.412 7.002L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002 1.563 1.571 1.564 4.025.002 5.588z"/></svg>
							Produk
						</a>
					</li>
					
					<li>
						<a href="transaksi.php" class="active">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.707 2.293A.996.996 0 0 0 12 2H3a1 1 0 0 0-1 1v9c0 .266.105.52.293.707l9 9a.997.997 0 0 0 1.414 0l9-9a.999.999 0 0 0 0-1.414l-9-9zM12 19.586l-8-8V4h7.586l8 8L12 19.586z"/><circle cx="7.507" cy="7.505" r="1.505"/></svg>
							Transaksi
						</a>
					</li>
					
					<li>
						<a href="history.php">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.707 19.707L12 13.414l4.461 4.461L14.337 20H20v-5.663l-2.125 2.124L13.414 12l4.461-4.461L20 9.663V4h-5.663l2.124 2.125L12 10.586 5.707 4.293 4.293 5.707 10.586 12l-6.293 6.293z"/></svg>
							Riwayat Transaksi
						</a>
					</li>
				</ul>
			</section>
		
			<section class="tools">
				<h3>Tools</h3>
				
				<ul>
					<li>
						<a href="../tambah.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13 7L11 7 11 11 7 11 7 13 11 13 11 17 13 17 13 13 17 13 17 11 13 11z"/><path d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10c5.514,0,10-4.486,10-10S17.514,2,12,2z M12,20c-4.411,0-8-3.589-8-8 s3.589-8,8-8s8,3.589,8,8S16.411,20,12,20z"/></svg>
							Tambah Produk
						</a>
					</li>
					
					<!-- <li>
						<a href="#">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 4H3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1zm-1 14H4V9.227l7.335 6.521a1.003 1.003 0 0 0 1.33-.001L20 9.227V18zm0-11.448l-8 7.11-8-7.111V6h16v.552z"/></svg>
							Messages
						</a>
					</li> -->
				</ul>
			</section>
			
			<!-- <section class="dicover">
				<h3>Finance</h3>
				
				<ul>
					<li>
						<a href="#">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21,3h-4V2h-2v1H9V2H7v1H3C2.447,3,2,3.447,2,4v17c0,0.553,0.447,1,1,1h18c0.553,0,1-0.447,1-1V4C22,3.447,21.553,3,21,3z M7,5v1h2V5h6v1h2V5h3v3H4V5H7z M4,20V10h16v10H4z"/><path d="M11,15.586l-1.793-1.793l-1.414,1.414l2.5,2.5C10.488,17.902,10.744,18,11,18s0.512-0.098,0.707-0.293l5-5l-1.414-1.414 L11,15.586z"/></svg>
							Invoice
						</a>
					</li>
					
					<li>
						<a href="#">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 12h2v3h-2z"/><path d="M21 7h-1V4a1 1 0 0 0-1-1H5c-1.206 0-3 .799-3 3v11c0 2.201 1.794 3 3 3h16a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zM5 5h13v2H5.012C4.55 6.988 4 6.805 4 6s.55-.988 1-1zm15 13H5.012C4.55 17.988 4 17.805 4 17V8.833c.346.115.691.167 1 .167h15v9z"/></svg>
							Wallet
						</a>
					</li>
				</ul>
			</section> -->
		</nav>
	</header>
	
	<main class="content-wrap">
		<header class="content-head">
			<h1>Transaksi</h1>
				
			<div class="action">
				<a href="../logout.php">
					<button>Logout</button>
				</a>
			</div>
		</header>
		
		<div class="content">
			<section class="info-boxes">	
				<div class="info-box">
					<div class="box-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 3C6.486 3 2 6.364 2 10.5c0 2.742 1.982 5.354 5 6.678V21a.999.999 0 0 0 1.707.707l3.714-3.714C17.74 17.827 22 14.529 22 10.5 22 6.364 17.514 3 12 3zm0 13a.996.996 0 0 0-.707.293L9 18.586V16.5a1 1 0 0 0-.663-.941C5.743 14.629 4 12.596 4 10.5 4 7.468 7.589 5 12 5s8 2.468 8 5.5-3.589 5.5-8 5.5z"/></svg>
					</div>
					
					<div class="box-content">
						<span class="big">
							<?php
								$jumlah_transaksi = mysqli_query($koneksi, "SELECT count(*) as status FROM transaksi WHERE status='1' ");
								while($jumlah_tran = mysqli_fetch_array($jumlah_transaksi)){
									echo $jumlah_tran['status'];
								}
							?>
						</span>
						Total Belum Dikonfirmasi
					</div>
				</div>
			</section>
		
			<section class="container-table">

                <table width='80%' border=1>

                    <tr>
                        <th>No Transaksi</th>
                        <th>Nama Printer</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                    <?php //Perulangan untuk tabel transaksi
                    while($hasil = mysqli_fetch_object($transaksi)) { if ($hasil->status == 1) { ?>
                        <tr>
                            <td class="text-center"><?= $hasil->IdTransaksi ?></td>
                            <td><?= $hasil->NamaPrinter ?></td>
							<td><?= "Rp. " . number_format($hasil->Jumlah, 0, ".", "."); ?></td>
                            <td class="text-center red">Belum Konfirmasi</td>
                            <td class="text-center"><a href="transaksi.php?id=<?= $hasil->IdTransaksi ?>">Konfirmasi</a></td>
                        </tr>   
                        <!-- <td><a href='edit.php?IdPrinter=$barang[IdPrinter]'>Edit</a> | <a href='delete.php?IdPrinter=$barang[IdPrinter]'>Delete</a></td></tr> -->
                    <?php
                    } }
                    ?>
                </table>

                <?php

                    //Script ini untuk mengubah status konfirmasi dari orderan pembeli
                    if (isset($_GET['id'])) {
                        
                        include '../../koneksi.php'; //Koneksi

                        $id = $_GET['id'];
                        $status = 2;

                        $query = "UPDATE transaksi SET status='$status' WHERE IdTransaksi = '$id'";
                        $run = mysqli_query($koneksi, $query);
                        
                        if ($run) {
                            header("location:transaksi.php");
                        }

                    }

                ?>
								
			</section>

		</div>
	</main>
</div>

</body>
</html>