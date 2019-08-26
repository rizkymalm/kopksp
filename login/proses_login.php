<?php
session_start();

include "../config/koneksi_mysqli.php";

// Dikirim dari form
if (isset($_POST['username']) && isset($_POST['password'])) {

	$username=$_POST['username'];
	$password=$_POST['password'];
	$query=$mysqli->query("SELECT * FROM t_user WHERE username='$username' AND password='$password'");
	$jumlah=mysqli_num_rows($query);
	$a=$query->fetch_assoc();

	if($jumlah > 0){
		if($a['level']=='admin')
		{
		$_SESSION['level']=$a['level'];
		$_SESSION['kopid']=$a['kode_user'];
		$_SESSION['kopname']=$a['nama'];
		header("location:../index.php?pilih=home");
		}
		else if($a['level']=='operator')
		{
		$_SESSION['level']=$a['level'];
		$_SESSION['kopid']=$a['kode_user'];
		$_SESSION['kopname']=$a['nama'];
		header("location:../index.php?pilih=home");
		}
		
	}else{
		echo'
		<script>
			alert("Username Atau Password Salah");
			window.location="login.php";
		</script>';
	}
}
?>

