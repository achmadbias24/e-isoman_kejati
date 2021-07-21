<?php
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\Exception;
      //include "config/koneksi.php";
      //cek data
     
      include ('assets/PHPMailer/src/Exception.php');
      include ('assets/PHPMailer/src/PHPMailer.php');
      include ('assets/PHPMailer/src/SMTP.php');

      function kirim_email_harian($penerima, $subject, $pesan)
      {
        
        $email_pengirim="pkl.kejati2021@gmail.com";
        $nama_pengirim='Kejaksaan Tinggi Jawa Timur';
        $email_penerima=$penerima;
        $subjek=$subject;
        $pesan=$pesan;

        $mail =  new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $email_pengirim;
        $mail->Password = 'vwfxbrilbasmhvsw';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 2;


        $mail->setFrom($email_pengirim, $nama_pengirim);
        $mail->addAddress($email_penerima);
        $mail->isHTML(true);
        $mail->Subject=$subjek;
        $mail->Body=$pesan;
        $mail->AddEmbeddedImage("img/pengusir_bosan.png", "pengusir_bosan", "pengusir_bosan.png");
        $mail->send();
      }
      function kirim_email_baru($penerima, $subject, $pesan)
      {
        
        $email_pengirim="pkl.kejati2021@gmail.com";
        $nama_pengirim='Kejaksaan Tinggi Jawa Timur';
        $email_penerima=$penerima;
        $subjek=$subject;
        $pesan=$pesan;

        $mail =  new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $email_pengirim;
        $mail->Password = 'vwfxbrilbasmhvsw';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 2;


        $mail->setFrom($email_pengirim, $nama_pengirim);
        $mail->addAddress($email_penerima);
        $mail->isHTML(true);
        $mail->Subject=$subjek;
        $mail->Body=$pesan;
        $mail->AddEmbeddedImage("img/panduan_isoman.png", "panduan_isoman", "panduan_isoman.png");
        $mail->AddEmbeddedImage("img/alamat_kebutuhan.jpg", "alamat_kebutuhan", "alamat_kebutuhan.jpg");
        $mail->send();
      }
      function kirim_email_selesai($penerima, $subject, $pesan)
      {

        $email_pengirim="pkl.kejati2021@gmail.com";
        $nama_pengirim='Kejaksaan Tinggi Jawa Timur';
        $email_penerima=$penerima;
        $subjek=$subject;
        $pesan=$pesan;

        $mail =  new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $email_pengirim;
        $mail->Password = 'vwfxbrilbasmhvsw';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 2;


        $mail->setFrom($email_pengirim, $nama_pengirim);
        $mail->addAddress($email_penerima);
        $mail->isHTML(true);
        $mail->Subject=$subjek;
        $mail->Body=$pesan;
        $mail->send();
      }
    ?>