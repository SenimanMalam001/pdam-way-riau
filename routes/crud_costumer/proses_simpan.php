<?php
// Panggil koneksi database
require_once "koneksi.php";

if (isset($_POST['simpan'])) {
	$no_rek        = $_POST['no_rek'];
	$nama          = $_POST['nama'];
	$email         = $_POST['email'];
	$no_hp   	   = $_POST['no_hp'];
	$alamat        = $_POST['alamat'];
	$keluhan       = $_POST['keluhan'];

	// perintah query untuk menyimpan data ke tabel tbl_keluhan
	$query = mysqli_query($db, "INSERT INTO tbl_keluhan(no_rek,
													 nama,
													 email,
													 no_hp,
													 alamat,
													 keluhan)	
											  VALUES('$no_rek',
													 '$nama',
													 '$email',
													 '$no_hp',
													 '$alamat',
													 '$keluhan')");		

	// cek hasil query
	if ($query) {
		// jika berhasil tampilkan pesan berhasil insert data
		header('location: ../keluhan.php?alert=2');
	} else {
		// jika gagal tampilkan pesan kesalahan
		header('location: ../keluhan.php?alert=1');
	}	
}
else {
	die("Akses dilarang...");
}					
?>