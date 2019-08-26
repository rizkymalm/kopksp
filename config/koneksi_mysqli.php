<?php
	// ini_set('display_errors',FALSE);
	$host	= "localhost";
	$user	= "root";
	$pass	= "";
	$db		= "rinookta";
	
	
	// $koneksi=mysql_connect($host,$user,$pass);
	// $db=mysql_select_db($db);
	
	$mysqli= new MySQLi($host,$user,$pass,$db) or die(mysql_error());

	// if ($koneksi&&$db){
	// 	//echo "berhasil : )";
	// }else{
	
	
	class Tabungan{
		private $saldo;
		function Tabungan($a){
			$this->saldo = $a;
		}
		function simpan($sim){
			$this->saldo = $this->saldo + $sim;
		}
		function pinjam($pin){
			$this->saldo = $this->saldo - $pin;
		}
		function cek_saldo(){
			return $this->saldo;
		}
	};
?>