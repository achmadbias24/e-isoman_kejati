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


    <title>INPUT DATA PEGAWAI</title>
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

    if (isset($_POST['btcek'])) {
      $nip=$_POST['nip'];
      $mulai_isoman=$_POST['mulai_isoman'];
      $tampil = mysqli_query($koneksi, "SELECT isoman.MULAI_ISOMAN,pegawai.* FROM isoman, pegawai WHERE pegawai.NIP='$nip' AND isoman.MULAI_ISOMAN='$mulai_isoman'");
      $data = mysqli_fetch_array($tampil);
      if($data)
      {
        //jika data ditemukan, maka data ditampung ke dalam variabel
        $vnip = $data['NIP'];
        $vnama = $data['NAMA_PEGAWAI'];
        $vpangkat = $data['PANGKAT'];
        $vjabatan = $data['JABATAN'];
        $valamat = $data['ALAMAT'];
        $vemail = $data['EMAIL'];
        $vmulai_isoman = $data['MULAI_ISOMAN'];
      }else{
        echo "<script>alert('Data Pegawai Tidak Ditemukan!')</script>";
      }
    }elseif (isset($_POST['bsimpan'])) {
      $tampil = mysqli_query($koneksi, "SELECT isoman.* FROM isoman WHERE MULAI_ISOMAN='$_POST[mulai_isoman]'");
      $data = mysqli_fetch_array($tampil);
      if($data){
        include "config/aksi2.php";
        include "modul/mailer/kirim_email.php";
        $file=upload("$_POST[nip]");
        $ket='SEMBUH';
        $query=("UPDATE isoman SET SELESAI_ISOMAN='$_POST[selesai_isoman]',FILE_PCR_NEGATIF='$file',KETERANGAN='$ket' WHERE ID_ISOMAN='$data[ID_ISOMAN]'");
        $simpan=mysqli_query($koneksi, $query);
        if ($simpan) {
          echo "<script>alert('Simpan Data Berhasil')</script>";

          $cek=mysqli_query($koneksi,"SELECT EMAIL FROM PEGAWAI WHERE NIP='$_POST[nip]'");
          $data1=mysqli_fetch_assoc($cek);
          $email_pengirim="pkl.kejati2021@gmail.com";
          $nama_pengirim='Kejaksaan Tinggi Jawa Timur';
          $email_penerima=($data1['EMAIL']);
          $subjek='Selesai Isolasi Mandiri';
          $pesan='Selamat Anda dinyatakan negatif Covid-19 dan selesai menjalani isolasi mandiri. Namun ingat, tetap patuhi protokol kesehatan kapanpun dan dimanapun Anda berada.';
          kirim_email_selesai($email_penerima, $subjek, $pesan);
          header("location:input_sembuh.php");
        }
      }
    }   
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
    <a href="../logout.php" class = "btn btn-danger" style="margin-right: 20px">Logout</a>
  </nav>

    <!--card-->
    <div class="card mt-3" style="margin-left: 150px; margin-right: 150px;">
      <div class="card-header bg-primary text-white text-center">
        Input Data Pegawai Sembuh
      </div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nip">Nomor Induk Pegawai (NIP)</label>
            <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" value="<?=@$vnip?>" >
          </div>
          <div class="form-group">
            <label for="mulai_isoman">Tanggal Mulai Isolasi Mandiri</label>
            <input type="text" class="form-control datepicker" id="mulai_isoman" name="mulai_isoman" placeholder="Masukkan Tanggal Mulai Isolasi Mandiri" value="<?=@$vmulai_isoman?>" >
          </div>
          <button type="submit" name="btcek" class="btn btn-primary">Cek Data</button>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?=@$vnama?>" readonly>
          </div>
          <div class="form-group">
            <label for="pangkat">Pangkat</label>
            <input type="text" class="form-control" id="pangkat" value="<?=@$vpangkat?>" name="pangkat" readonly>
          </div>
          <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" value="<?=@$vjabatan?>" name="jabatan" readonly>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat Domisili</label>
            <input type="text" class="form-control" id="alamat" value="<?=@$valamat?>" name="alamat" readonly>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" value="<?=@$vemail?>" name="email" readonly>
          </div>
          <div class="form-group">
            <label for="selesai_isoman">Tanggal Selesai Isolasi Mandiri</label>
            <input type="text" class="form-control datepicker" id="selesai_isoman" name="selesai_isoman">
          </div>
          <div class="form-group">
            <label for="file">File Scan Hasil PCR Negatif Covid-19</label>
            <input type="file" class="form-control" id="file" name="file">
          </div>
          
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModalCenter">
            Simpan Data
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Validasi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 Apakah Anda yakin ingin menyimpan data ini?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" name="bsimpan" class="btn btn-success">Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
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
