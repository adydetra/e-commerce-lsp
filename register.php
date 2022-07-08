<?php 

include 'koneksi.php';

error_reporting(0);

session_start();

if (isset($_SESSION['Username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$Username = $_POST['Username'];
	$Password = ($_POST['Password']);
	$cPassword = ($_POST['cPassword']);

	if ($Password == $cPassword) {
		$sql = "SELECT * FROM user WHERE Username='$Username'";
		$result = mysqli_query($koneksi, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO user (Username, Password)
					VALUES ('$Username', '$Password')";
			$result = mysqli_query($koneksi, $sql);
			if ($result) {
				echo ("<script LANGUAGE='JavaScript'>
                window.alert('Berhasil! Silahkan isi form Login');
                window.location.href='login.php';
                </script>");
				$Username = "";
				$_POST['Password'] = "";
				$_POST['cPassword'] = "";
			} else {
				echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Username Sudah Terdaftar.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Tidak Sesuai')</script>";
	}
}

?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce | Register</title>
    <link rel="stylesheet" href="css/login.css" type="text/css">
    <link rel="icon" href="img/login.svg">
</head>
<body>
    <section>
        <div class="col-1">
            <img src="img/login.svg">
        </div>
        <div class="col-2">
            <a class="kembali" href="index.php">Kembali</a>
            <form action="" method="POST">
                <h1>Create Your Account</h1>
                <input type="text" placeholder="Username" name="Username" value="<?php echo $Username; ?>" required autofocus>
                <input type="password" placeholder="Password" name="Password" value="<?php echo $_POST['Password']; ?>" required>
                <input type="password" placeholder="Confirm Password" name="cPassword" value="<?php echo $_POST['cPassword']; ?>" required>
                <button name="submit" class="button">Register</button>
                <p>Sudah Memiliki Akun?<a href="login.php">Login</a></p>
            </form>
        </div>
    </section>
</body>
</html>