 <!-- Aplikasi CRUD
 ************************************************
 * Developer    : Indra Styawantoro
 * Company      : Indra Studio
 * Release Date : 1 Maret 2016
 * Website      : http://www.indrasatya.com, http://www.kulikoding.net
 * E-mail       : indra.setyawantoro@gmail.com
 * Phone        : +62-856-6991-9769
 * BBM          : 7679B9D9
 -->

<?php
// Panggil koneksi database
require_once "koneksi.php";

if (isset($_GET['id'])) {

	$no_rek = $_GET['id'];
	
	// perintah query untuk menghapus data pada tabel is_siswa
	$query = mysqli_query($db, "DELETE FROM tbl_keluhan WHERE no_rek='$no_rek'");

	// cek hasil query
	if ($query) {
		// jika berhasil tampilkan pesan berhasil delete data
		header('location: keluhan.php?alert=4');
	} else {
		// jika gagal tampilkan pesan kesalahan
		header('location: keluhan.php?alert=1');
	}	
}							
?>