<div class="row mt">
  <div class="col-lg-12">
     <div class="form-panel">
     <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Laporan Keuangan
        </h4>
        
     <div class="row">
        <?php 
        include 'config/koneksi_mysqli.php';
        $simpan=$mysqli->query("SELECT sum(besar_simpanan) as simpan from t_simpan")->fetch_assoc();
       	
       	//$tabung=->fetch_assoc($mysqli->query("SELECT sum(besar_tabungan) as tabung from t_tabungan"));
       	//echo $tabung['tabung'];
       	$angsur=$mysqli->query("SELECT sum(besar_angsuran) as angsuran from t_angsur")->fetch_assoc();
       	//echo $angsur['angsuran'];
       	$denda=$mysqli->query("SELECT sum(denda) as denda from t_angsur")->fetch_assoc();
       	//echo $denda['denda'];
       	$pinjam=$mysqli->query("SELECT sum(besar_pinjam) as pinjam from t_pinjam")->fetch_assoc();
       	$ambil=$mysqli->query("SELECT sum(besar_ambil) as ambil from t_pengambilan")->fetch_assoc();
       	
       	$pendapatan=$simpan['simpan']+$angsur['angsuran']+$denda['denda'];
       	$pengambilan=$pinjam['pinjam']+$ambil['ambil'];
       	$sisapen=$pendapatan-$pengambilan;

        ?>
    	<div class="col-lg-3 col-xs-10">
          <!--  -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5bc0de; ">
              <div class="panel-heading"  style="background-color:#5bc0de; color:#fff;"><h5>Pendapatan </h5></div>
              <div class="panel-body">
               <span style="font-size:20px;"><?php echo 'Rp. '.number_format($pendapatan);//.' '.$tabung['tabung'].' '.$angsur['angsuran'].' '.$denda['denda']; ?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-10">
          <!--  -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5bc0de; ">
              <div class="panel-heading"  style="background-color:#5bc0de; color:#fff;"><h5>Pengeluaran </h5></div>
              <div class="panel-body">
               <span style="font-size:20px;"><?php echo 'Rp. '.number_format($pengambilan);//.' '.$tabung['tabung'].' '.$angsur['angsuran'].' '.$denda['denda']; ?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-10">
          <!--  -->
          <div class="small-box">
            <div class="panel" style="border: 2px solid#5bc0de; ">
              <div class="panel-heading"  style="background-color:#5bc0de; color:#fff;"><h5>Aktiva </h5></div>
              <div class="panel-body">
               <span style="font-size:20px;"><?php echo 'Rp. '.number_format($sisapen);//.' '.$tabung['tabung'].' '.$angsur['angsuran'].' '.$denda['denda']; ?></span>
              </div>
            </div>
          </div>
        </div>
     </div>
  </div>
</div>
</div>