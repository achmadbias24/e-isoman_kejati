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
    <script src="assets/js/Chart.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
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
    <div class="card mt-3" style="margin-left: 150px; margin-right: 150px;">
      <div class="card-header bg-primary text-white text-center">
        Grafik Pegawai Isolasi Mandiri
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <canvas id="konfirmChart"></canvas>
          </div>
          <div class="col-md-6">
            <canvas id="isomanChart"></canvas>
          </div>
          <div class="col-md-6">
            <canvas id="sembuhChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    
    
    
   <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2" style="background-color: #654321;">
    Kejaksaan Tinggi Jawa Timur 2021
   </footer>

   <script type="text/javascript">
      var konfirm = document.getElementById('konfirmChart').getContext('2d');
      var isoman = document.getElementById('isomanChart').getContext('2d');
      var sembuh = document.getElementById('sembuhChart').getContext('2d');
      var myChart = new Chart(konfirmChart, {
          type: 'bar',
          data: {
              labels: ['Jan-Mar','Apr-Jun','Jul-Sept','Okt-Des'],
              datasets: [{
                  label: "Total Pegawai Isolasi Mandiri",
                  backgroundColor: 'rgba(0, 122, 255, 0.7)',
                  data: [
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE MONTH(MULAI_ISOMAN) BETWEEN '01' AND '03'");
                      echo mysqli_num_rows($jumlah_konfirm);
                      ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE MONTH(MULAI_ISOMAN) BETWEEN '04' AND '06'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE MONTH(MULAI_ISOMAN) BETWEEN '07' AND '09'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE MONTH(MULAI_ISOMAN) BETWEEN '10' AND '12'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>
                  ],
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
       var myChart = new Chart(isomanChart, {
          type: 'bar',
          data: {
              labels: ['Jan-Mar','Apr-Jun','Jul-Sept','Okt-Des'],
              datasets: [{
                  label: "Masih Isolasi Mandiri",
                  backgroundColor: 'rgba(206, 181, 70, 0.7)',
                  data: [
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE KETERANGAN='MASIH ISOLASI MANDIRI' AND MONTH(MULAI_ISOMAN) BETWEEN '01' AND '03'");
                      echo mysqli_num_rows($jumlah_konfirm);
                      ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE KETERANGAN='MASIH ISOLASI MANDIRI' AND MONTH(MULAI_ISOMAN) BETWEEN '04' AND '06'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE KETERANGAN='MASIH ISOLASI MANDIRI' AND MONTH(MULAI_ISOMAN) BETWEEN '07' AND '09'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE KETERANGAN='MASIH ISOLASI MANDIRI' AND MONTH(MULAI_ISOMAN) BETWEEN '10' AND '12'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>
                  ],
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
      var myChart = new Chart(sembuhChart, {
          type: 'bar',
          data: {
              labels: ['Jan-Mar','Apr-Jun','Jul-Sept','Okt-Des'],
              datasets: [{
                  label: "Terkonfirmasi Sembuh",
                  backgroundColor: 'rgba(39, 168, 68, 0.7)',
                  data: [
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE KETERANGAN='SEMBUH' AND MONTH(MULAI_ISOMAN) BETWEEN '01' AND '03'");
                      echo mysqli_num_rows($jumlah_konfirm);
                      ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE KETERANGAN='SEMBUH' AND MONTH(MULAI_ISOMAN) BETWEEN '04' AND '06'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE KETERANGAN='SEMBUH' AND MONTH(MULAI_ISOMAN) BETWEEN '07' AND '09'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>,
                    <?php 
                      $jumlah_konfirm = mysqli_query($koneksi,"SELECT * FROM isoman WHERE KETERANGAN='SEMBUH' AND MONTH(MULAI_ISOMAN) BETWEEN '10' AND '12'");
                      echo mysqli_num_rows($jumlah_konfirm);
                    ?>
                  ],
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
    </script>
    
    
  </body>
</html>
