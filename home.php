<?php
      session_start();
      if(empty($_SESSION['username'])){
        echo "<script>alert('Maaf, Anda harus login terlebih dahulu untuk mengakses halaman ini!');
        document.location='index.php';</script>";
      }
      $nama = $_SESSION['nama'];
    ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets\bootstrap-4.0.0\dist\css\bootstrap.min.css">
    <script src="assets/js/jquery.js"></script>
    <link rel="stylesheet" href="assets/datepicker/css/datepicker.css">


    <title>PENDATAAN PEGAWAI ISOLASI MANDIRI</title>
  </head>
  <body>
    
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

    <!--jumbotron-->
    <div class="jumbotron jumbotron-fluid mt-5" style="margin-left: 50px; margin-right: 50px;">
	  <div class="container">
	    <h1 class="display-4">Selamat Datang <?php echo "$nama"?></h1>
	    <p class="lead">Gunakan menu di atas untuk menginputkan data pegawai yang sedang isolasi mandiri<br>dan melihat grafik pegawai yang melaksanakan isolasi mandiri.</p>
	  </div>
	</div>
    
    
	 <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2 fixed-bottom" style="background-color: #654321;">
	 	Kejaksaan Tinggi Jawa Timur 2021
	 </footer>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
