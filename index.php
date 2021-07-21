
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap-4.0.0/dist/css/bootstrap.min.css">

    <title>LOGIN ADMIN</title>
  </head>
  <body>

    <?php
      session_start();
      if (!empty($_SESSION['username'])) {
        header("location:index.php");
      }
    ?>

	  <!-- Image and text -->
    <nav class="navbar" style="background-color: #654321; padding: 0px">
      <a href="index.php">
        <img src="img/banner.png" style="width: 110%;">
      </a>
    </nav>
    <br>
    <h1 class = "text-center">Login Pendataan Pegawai Isolasi Mandiri</h1>
    <br>
    <p class = "text-center">Silakan login untuk mendata pegawai yang sedang melaksanakan isolasi mandiri</p>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header bg-transparent mb-0"><h5 class="text-center"><span class="font-weight-bold text-dark">LOGIN</span></h5></div>
            <div class="card-body">
              <form action="login.php" method="POST">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

	 <footer class="text-center text-white mt-3 bt-2 pb-2 pt-2 fixed-bottom" style="background-color: #654321;">
	 	Kejaksaan Tinggi Jawa Timur 2021
	 </footer>
  </body>
</html>
