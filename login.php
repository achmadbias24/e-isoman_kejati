<?php
include 'config/koneksi.php';
include 'modul/mailer/kirim_email.php';
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
$result = mysqli_query($koneksi, $query);
if(!$result){
    die("Query error:".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
}

$data=mysqli_fetch_array($result);
if ($data){
	//inisialisasi session
	session_start();
	$_SESSION['username'] = $data['username'];
	$_SESSION['nama'] = $data['nama'];
		$d1=date('d-m-Y');
      $tampil=mysqli_query($koneksi,"SELECT pegawai.EMAIL, isoman.MULAI_ISOMAN, isoman.COUNTER FROM pegawai, isoman WHERE pegawai.NIP=isoman.NIP AND isoman.KETERANGAN='MASIH ISOLASI MANDIRI' AND COUNTER='1' OR COUNTER='2'");

      while ($data=mysqli_fetch_assoc($tampil)) {
        $d2=date('d-m-Y',strtotime($data['MULAI_ISOMAN']));
        $c=$data['COUNTER'];
        if ($d1 >= date('d-m-Y', strtotime('+5 days',strtotime($d2))) && $c == 1) {
          $subjek='Update 5 Harian Pegawai Isolasi Mandiri';
          $pesan='Anda telah menjalani isolasi mandiri selama 5 hari. Tetap patuhi protokol isolasi mandiri, konsumsi makanan dan minuman yang bergizi tinggi, serta dapat berolah raga ringan namun tetap #DiRumahSaja.<br><br>
            <img src="cid:pengusir_bosan">';
          $email_penerima=($data['EMAIL']);
          kirim_email_harian($email_penerima,$subjek,$pesan);
          $simpan=mysqli_query($koneksi,"UPDATE isoman SET COUNTER='2' WHERE COUNTER='1'");

        }elseif ($d1 >= date('d-m-Y', strtotime('+10 days',strtotime($d2))) && $c == 2) {
          $subjek='Update 10 Harian Pegawai Isolasi Mandiri';
          $pesan='Anda telah menjalani isolasi mandiri selama 10 hari. Semoga kondisi Anda semakin membaik dan senantiasa diberi perlindungan oleh Tuhan Yang Maha Esa.';
          $email_penerima=($data['EMAIL']);
          kirim_email_harian($email_penerima, $subjek, $pesan);
          $simpan=mysqli_query($koneksi,"UPDATE isoman SET COUNTER='3' WHERE COUNTER='2'");
        }else{
          header("location:home.php");
        }
      }header("location:home.php");
}
else
{
	echo "<script>
			alert('Maaf, Login GAGAL, pastikan username dan password anda Benar..!');
			document.location='index.php';
		  </script>";
}
?>