<?php
session_start();

if(!isset($_SESSION['logged_in']))
{
 header("Location: index.php");
}

require_once ('koneksi.php');

$session = $_SESSION['logged_in'];
/*
$query  = "SELECT * FROM tbl_users WHERE id_user = '$session'";
$result = mysqli_query($connection,$query)or die(mysqli_error());
$row     = mysqli_fetch_array($result);*/

?>

<!DOCTYPE html>
<!--
/*
@package : Login PHP dan Mysqli
@author  : Fika Ridaul Maulayya
@since   : 2016
@license : https://www.rubypedia.com
*/
-->
<html>
<head>
	<title> Dashboard - Keluhan</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	 <!-- favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/datepicker.min.css" rel="stylesheet">
    
    <!-- styles -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>


		<?php 
			if (isset($_POST['cari'])) {
			  $cari = $_POST['cari'];
			} else {
			  $cari = "";
			}
		?>

	<div class="col-md-12">
 
		
      
		<div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>no_rek</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No Hp</th>
                  <th>Alamat</th>
                  <th>Keluhan</th>
                </tr>
              </thead>   

              <tbody>
              <?php
              $no = 1;
              if (isset($cari)) {
                $query = mysqli_query($db, "SELECT * FROM tbl_keluhan
                                            WHERE no_rek LIKE '%$cari%' OR nama LIKE '%$cari%' 
                                            ORDER BY no_rek ASC") 
                                            or die('Ada kesalahan pada query siswa: '.mysqli_error($db));
              } else {
                $query = mysqli_query($db, "SELECT * FROM tbl_keluhan
                                            ORDER BY no_rek ASC LIMIT ")
                                            or die('Ada kesalahan pada query siswa: '.mysqli_error($db));
              }

              $no = 1;
			  /*$sql = "SELECT * FROM tbl_keluhan";
			  $query = mysqli_query($db, $sql);
              */

              while ($data = mysqli_fetch_assoc($query)) {

                echo "  <tr>
                      <td width='30' class='center'>$no</td>
                      <td width='60'>$data[no_rek]</td>
                      <td width='120'>$data[nama]</td>
                      <td width='120'>$data[email]</td>
                      <td width='120'>$data[no_hp]</td>
                      <td width='200'>$data[alamat]</td>
                      <td width='100'>$data[keluhan]</td>";

                    
              ?>
              <?php
                echo "
                        </div>
                      </td>
                    </tr>";
                $no++;
              }
              ?>
              </tbody>           
            </table>
           
           
          </div>
        </div>
			</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>
</body>
</html>