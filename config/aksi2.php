<?php

//persiapan function untuk upload file/foto
function upload($nip)
{
	//deklarasikan variabel kebutuhan
	$namafile = $_FILES['file']['name'];
	$ukuranfile = $_FILES['file']['size'];
	$error = $_FILES['file']['error'];
	$tmpname = $_FILES['file']['tmp_name'];


	//cek apakah yang diupload adalah file/gambar
	$eksfilevalid = ['pdf','jpg','jpeg','png'];
	$eksfile = explode('.', $namafile); 
	$eksfile = strtolower(end($eksfile));
	
	if(!in_array($eksfile, $eksfilevalid)){
		echo "<script> alert('Yang anda Upload bukan PDF / JPEG / JPG / PNG..!') </script>";
		return false;	
	}

	//cek jika ukuran file terlalu besar
	if($ukuranfile > 1044070){
		echo "<script> alert('Ukuran file anda terlalu besar!') </script>";
		return false;
	}

	//jika lolos pengecekkan, file siap diupload
	//generate nama file baru

	$namafilebaru = "PCR_NEGATIF_".$nip;
	$namafilebaru .= '.';
	$namafilebaru .= $eksfile;

	move_uploaded_file($tmpname, 'file/'.$namafilebaru);
	return $namafilebaru;

}


?>