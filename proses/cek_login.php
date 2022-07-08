<?php 

	//Sesi
	session_start();
	
	//Koneksi
	include '../koneksi.php';
	
	// Menangkap data yang dikirim dari form
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	
	// Menyeleksi data admin dengan Username dan Password yang sesuai
	$data = mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$Username' AND Password='$Password'");
	$hasil = mysqli_fetch_object($data);
	
	// Menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($data);
	
	if($cek > 0){
		$_SESSION['Username'] = $Username;
		$_SESSION['status'] = "login";
		$_SESSION['id_user'] = $hasil->IdUser;

		if ($_POST['Username'] == 'admin') {
			header('Location:../admin/dashboard.php');
		}
		else {
			header("Location:../index.php");
		}
	} 
	
	//Jika salah akan muncul notifikasi "gagal" di URL
	else{
		header("location:../login.php?pesan=gagal");
	}
?>