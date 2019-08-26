<?php
	include "../config/koneksi_mysqli.php";
	if (isset($_POST['kode_anggota'])) {
		$kode_anggota=$_POST['kode_anggota'];
		$nama_anggota=$_POST['nama_anggota'];
		$alamat_anggota=$_POST['alamat_anggota'];
		$jenis_kelamin=$_POST['jenis_kelamin'];
		$pekerjaan=$_POST['pekerjaan'];
		$tgl_masuk=$_POST['tgl_masuk'];
		// $tgl_keluar=$_POST['tgl_keluar'];
		$telp=$_POST['telp'];
		$tempat_lahir=$_POST['tmp_lahir'];
		$tgl_lahir=$_POST['tgl_lahir'];
		// $photo=$_POST['photo'];
		$u_entry=$_POST['u_entry'];
		$tgl_entri=$_POST['tgl_entri'];
	}
	$pros=$_GET['pros'];
	
	switch ($pros){
		case "tambah" :
			$q=$mysqli->query("SELECT besar_simpanan FROM t_jenis_simpan WHERE nama_simpanan='pokok'")->fetch_assoc();
			$pokok	= $q['besar_simpanan'];
			$qu=$mysqli->query("INSERT INTO t_tabungan VALUES('','$kode_anggota','$tgl_entri','$pokok')");
			$f=$mysqli->query("INSERT INTO t_simpan values('','pokok','$pokok','$kode_anggota','$u_entry','$tgl_entri','$tgl_entri')");
			$que=$mysqli->query("SELECT max(kode_tabungan) AS a FROM t_tabungan");
			$dt =$que->fetch_assoc();

				$mysqli->query("INSERT INTO t_anggota values('$kode_anggota','$dt[a]','$nama_anggota','$alamat_anggota','$jenis_kelamin','$pekerjaan','$tgl_masuk','$telp','$tempat_lahir','$tgl_lahir','aktif','$u_entry','$tgl_entri')");?>
				<script>
					alert("Tambah anggota berhasil");
					window.location="../index.php?pilih=1.2";
				</script>
			<?php
		break;
		case "keluar" :
		$kode=$_GET['kode_anggota'];
		$tuggak=mysqli_num_rows($mysqli->query("SELECT * from t_pinjam where kode_anggota='$kode' and status='belum lunas' order by kode_pinjam desc "));
		if($tuggak>0)
		{ ?>
			<script>alert("Maaf Aggota ini masih ada tunggakan");window.location="../index.php?pilih=1.2";</script>
		<?php }
		else if($tunggak==0)
		{
			//$mysqli->query("DELETE FROM t_pinjam where kode_anggota='$kode'");
			//$mysqli->query("DELETE FROM t_angsur where kode_anggota='$kode'");
			//$mysqli->query("DELETE FROM t_simpan where kode_anggota='$kode'");
			$mysqli->query("DELETE FROM t_pengajuan where kode_anggota='$kode'");
			$qdelete=$mysqli->query("UPDATE t_anggota set status='keluar' WHERE kode_anggota='$kode'");
			if($qdelete){ 
				$tunjangan=$mysqli->query("SELECT * from t_tabungan where kode_anggota='$kode'")->fetch_assoc();
				$jadine=$tunjangan['besar_tabungan'];?>
				<script>
					window.open('notatunjang.php?kode_anggota=<?php echo $kode; ?>&tunjangan=<?php echo $jadine; ?>','popuppage','width=500,toolbar=1,resizable=1,scrollbars=yes,height=450,top=30,left=100');
					<?php $mysqli->query("DELETE FROM t_tabungan where kode_anggota='$kode'"); $dat=date("Y-m-d");
					$mysqli->query("INSERT INTO t_pengambilan values('','$kode','','$jadine','$dat')"); ?>
					window.location="../index.php?pilih=1.2";
				</script>
				<?php //$mysqli->query("DELETE FROM t_tabungan where kode_anggota='$kode'");
						//header("");
			}else{
				echo "Hapus Data Gagal!!!!";
			}
		}	
		break;
		case "hapus" :
		$kode=$_GET['kode_anggota'];
		$tuggak=mysqli_num_rows($mysqli->query("SELECT * from t_pinjam where kode_anggota='$kode' and status='belum lunas' order by kode_pinjam desc "));
		if($tuggak>0)
		{ 
		?>
			<script>alert("Maaf Aggota ini masih ada tunggakan");window.location="../index.php?pilih=1.2";</script>
		<?php }
		else if($tunggak==0)
		{
			$mysqli->query("DELETE FROM t_pinjam where kode_anggota='$kode'");
			$mysqli->query("DELETE FROM t_angsur where kode_anggota='$kode'");
			$mysqli->query("DELETE FROM t_simpan where kode_anggota='$kode'");
			$mysqli->query("DELETE FROM t_tabungan where kode_anggota='$kode'");
			$mysqli->query("DELETE FROM t_pengajuan where kode_anggota='$kode'");
			$mysqli->query("DELETE FROM t_pengambilan where kode_anggota='$kode'");
			$qdelete=$mysqli->query("UPDATE t_anggota set status='keluar' WHERE kode_anggota='$kode'");
			if($qdelete){ ?>
				<script>
					// window.location="../index.php?pilih=1.2";
				</script>
				<?php //$mysqli->query("DELETE FROM t_tabungan where kode_anggota='$kode'");
						//header("");
			}else{
				echo "Hapus Data Gagal!!!!";
			}
		}	
		break;
		default : break; 
	}
	
?>