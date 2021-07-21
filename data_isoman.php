<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets\bootstrap-4.0.0\dist\css\bootstrap.min.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/datepicker/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="assets/datepicker/css/datepicker.css">


    <title>DAFTAR PEGAWAI ISOMAN</title>
  </head>
  <body>
    <?php
    session_start();
    if(empty($_SESSION['username'])){
    	echo "<script>alert('Maaf, Anda harus login terlebih dahulu untuk mengakses halaman ini!');
    	document.location='index.php';</script>";
    }

    include 'config/koneksi.php';
    $nama = $_SESSION['nama'];

    
    ?>

	  <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #654321;padding: 0%">
	  <a href="home.php"><img src="img/banner.png" style="width: 110%"></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Input Data Pegawai
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="input_isoman.php">Isolasi Mandiri</a>
            <a class="dropdown-item" href="input_sembuh.php">Sembuh</a>
          </div>
        </li>
	      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Daftar Pegawai & Grafik
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="data_isoman.php">Isolasi Mandiri</a>
            <a class="dropdown-item" href="data_sembuh.php">Sembuh</a>
            <a class="dropdown-item" href="grafik.php">Grafik</a>
          </div>
        </li>
	    </ul>
	  </div>
	  <a href="logout.php" class = "btn btn-danger" style="margin-right: 20px">Logout</a>
	</nav>

    <!--card-->
    <div class="card mt-3" style="margin-left: 50px; margin-right: 50px;">
      <div class="card-header bg-primary text-white text-center">
        Daftar Pegawai Isolasi Mandiri
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label for="nip">Tampilkan Data Berdasarkan NIP</label>
              <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP">
            </div>
            <div class="form-group">
              <label for="tgl">Tampilkan Data Berdasarkan Tanggal</label>
              <input type="text" class="form-control datepicker" id="tgl" name="tgl" placeholder="Masukkan Tanggal">
            </div>
            <button type="submit" name= "btcek" class="btn btn-primary">Tampilkan Data</button>
          </form>
          <table class="table table-borderd table-hovered table-striped mt-3">
            <tr class="text-center">
              <th>No</th>
              <th>NIP</th>
              <th>Nama Pegawai</th>
              <th>Pangkat</th>
              <th>Jabatan</th>
              <th>Alamat</th>
              <th>Mulai Isoman</th>
              <th>File Hasil Tes PCR Positif Covid-19</th>
              <th>Keterangan</th>
            </tr>

            <?php 
              $batas = 5;
              $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
              $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  
              $previous = $halaman - 1;
              $next = $halaman + 1;
              if (isset($_POST['btcek'])) {
                if (!empty($_POST['nip'])) {
                  if (!empty($_POST['tgl'])) {
                    $data = mysqli_query($koneksi,"SELECT pegawai.*,isoman.* FROM pegawai,isoman WHERE isoman.NIP=pegawai.NIP AND isoman.NIP='$_POST[nip]' AND isoman.MULAI_ISOMAN='$_POST[tgl]' AND KETERANGAN='MASIH ISOLASI MANDIRI'");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
                    $data_pegawai = mysqli_query($koneksi,"SELECT pegawai.*,isoman.* FROM pegawai,isoman WHERE isoman.NIP='$_POST[nip]' AND isoman.MULAI_ISOMAN='$_POST[tgl]' AND isoman.NIP=pegawai.NIP AND KETERANGAN='MASIH ISOLASI MANDIRI'limit $halaman_awal, $batas");
                    $nomor = $halaman_awal+1;
                    
                  }else{
                    $data = mysqli_query($koneksi,"SELECT pegawai.*,isoman.* FROM pegawai,isoman WHERE isoman.NIP='$_POST[nip]' AND isoman.NIP=pegawai.NIP AND KETERANGAN='MASIH ISOLASI MANDIRI'");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);
                    $data_pegawai = mysqli_query($koneksi,"SELECT pegawai.*,isoman.* FROM pegawai,isoman WHERE isoman.NIP='$_POST[nip]'AND isoman.NIP=pegawai.NIP AND KETERANGAN='MASIH ISOLASI MANDIRI'limit $halaman_awal, $batas");
                   $nomor = $halaman_awal+1;
                  }
                }else{
                  $data = mysqli_query($koneksi,"SELECT pegawai.*,isoman.* FROM pegawai,isoman WHERE isoman.MULAI_ISOMAN='$_POST[tgl]' AND isoman.NIP=pegawai.NIP AND KETERANGAN='MASIH ISOLASI MANDIRI'");
                  $jumlah_data = mysqli_num_rows($data);
                  $total_halaman = ceil($jumlah_data / $batas);
                  $data_pegawai = mysqli_query($koneksi,"SELECT pegawai.*,isoman.* FROM pegawai,isoman WHERE isoman.MULAI_ISOMAN='$_POST[tgl]' AND isoman.NIP=pegawai.NIP AND KETERANGAN='MASIH ISOLASI MANDIRI'limit $halaman_awal, $batas");
                  $nomor = $halaman_awal+1;
                }
              }else{
                $data = mysqli_query($koneksi,"SELECT pegawai.*,isoman.* FROM pegawai,isoman WHERE pegawai.NIP=isoman.NIP and KETERANGAN='MASIH ISOLASI MANDIRI'");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);
                $data_pegawai = mysqli_query($koneksi,"SELECT pegawai.*,isoman.* FROM pegawai,isoman WHERE pegawai.NIP=isoman.NIP  and KETERANGAN='MASIH ISOLASI MANDIRI' limit $halaman_awal, $batas");
                $nomor = $halaman_awal+1;
              }
              while($d=mysqli_fetch_array($data_pegawai)){  
            ?>
              <tr>
                <td><?=$nomor++;?></td>
                <td><?=$d['NIP']?></td>
                <td><?=$d['NAMA_PEGAWAI']?></td>
                <td><?=$d['PANGKAT']?></td>
                <td><?=$d['JABATAN']?></td>
                <td><?=$d['ALAMAT']?></td>
                <td><?=date('d-m-Y',strtotime($d['MULAI_ISOMAN']))?></td>
                <td class="text-center">
                  <?php
                    //uji apakah file nya ada atau tidak
                    if(empty($d['FILE_PCR_POSITIF'])){
                      echo " - ";
                    }else{
                  ?>
                    <a href="file/<?=$d['FILE_PCR_POSITIF']?>" target="_blank"> lihat file </a>
                  <?php
                    }
                  ?>
                </td>
                <td><?=$d['KETERANGAN']?></td>
            </tr>
              <?php
              }
              ?>
          </table>
      </div>
      
    <nav>
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Sebelumnya</a>
        </li>
        <?php 
        for($x=1;$x<=$total_halaman;$x++){
          ?> 
          <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
          <?php
        }
        ?>        
        <li class="page-item">
          <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Selanjutnya</a>
        </li>
      </ul>
    </nav>
    </div>
    
    
    
	 <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2" style="background-color: #654321;">
	 	Kejaksaan Tinggi Jawa Timur 2021
	 </footer>

   <script type="text/javascript">
        $(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>
    <script src="assets/js/bootstrap.min.js"></script>
    
  </body>
</html>
