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
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">PDAM WAY RIAU</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        	<div class="navbar-form navbar-right">
				<a href="logout.php" type="submit" class="btn btn-success"><i class="fa fa-sign-out"></i> Logout</a>
        	</div>
      </div>
    </nav>
<div class="container" style="margin-top: 40px">
	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
			  <a href="#" class="list-group-item active" style="text-align: center;background-color: #5bc0de; border-color: #46b8da">
			    ADMINISTRATOR
			  </a>
			  
			  <a href="dashboard.php" class="list-group-item"><i class="fa fa-dashboard"></i> Dashboard</a>
			  <a href="keluhan.php" class="list-group-item"><i class="fa fa-comments-o"></i> Keluhan</a>
			  <a href="logout.php" class="list-group-item"><i class="fa fa-sign-out"></i> Logout</a>
			</div>
		</div>
		<?php 
			if (isset($_POST['cari'])) {
			  $cari = $_POST['cari'];
			} else {
			  $cari = "";
			}
		?>

		<div class="col-md-9">
      <h4>
          <i class="glyphicon glyphicon-user"></i> Data Keluhan
          
          <div class="pull-right btn-tambah">
            <form class="form-inline" method="POST" action="index.php">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-search"></i>
                  </div>
                  <input type="text" class="form-control" name="cari" placeholder="Cari ..." autocomplete="off" value="<?php echo $cari; ?>">
                </div>
              </div>
              <a class="btn btn-info" href="cetak.php" target="_blank">
                <i class="glyphicon glyphicon-plus"></i> Cetak
              </a>
            </form>
          </div>
        </h4>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><i class="fa fa-dashboard"></i> Keluhan</h3>
			  </div>
        <?php  
					  if (empty($_GET['alert'])) {
					    echo "";
					  } elseif ($_GET['alert'] == 1) {
					    echo "<div class='alert alert-danger alert-dismissible' role='alert'>
					            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					              <span aria-hidden='true'>&times;</span>
					            </button>
					            <strong><i class='glyphicon glyphicon-alert'></i> Gagal!</strong> Terjadi kesalahan.
					          </div>";
					  } elseif ($_GET['alert'] == 2) {
					    echo "<div class='alert alert-success alert-dismissible' role='alert'>
					            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					              <span aria-hidden='true'>&times;</span>
					            </button>
					            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data keluhan berhasil dikirim.
					          </div>";
					  } elseif ($_GET['alert'] == 3) {
					    echo "<div class='alert alert-success alert-dismissible' role='alert'>
					            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					              <span aria-hidden='true'>&times;</span>
					            </button>
					            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data siswa berhasil diubah.
					          </div>";
					  } elseif ($_GET['alert'] == 4) {
					    echo "<div class='alert alert-success alert-dismissible' role='alert'>
					            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					              <span aria-hidden='true'>&times;</span>
					            </button>
					            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data siswa berhasil dihapus.
					          </div>";
					  }
					  ?>  
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
                  <th>Aksi</th>
                </tr>
              </thead>   

              <tbody>
              <?php
              /* Pagination */
              $batas = 5;

              if (isset($cari)) {
                $jumlah_record = mysqli_query($db, "SELECT * FROM tbl_keluhan
                                                    WHERE no_rek LIKE '%$cari%' OR nama LIKE '%$cari%'")
                                                    or die('Ada kesalahan pada query jumlah_record: '.mysqli_error($db));
              } else {
                $jumlah_record = mysqli_query($db, "SELECT * FROM tbl_keluhan")
                                                    or die('Ada kesalahan pada query jumlah_record: '.mysqli_error($db));
              }

              $jumlah  = mysqli_num_rows($jumlah_record);
              $halaman = ceil($jumlah / $batas);
              $page    = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
              $mulai   = ($page - 1) * $batas;
              /*-------------------------------------------------------------------*/
              $no = 1;
              if (isset($cari)) {
                $query = mysqli_query($db, "SELECT * FROM tbl_keluhan
                                            WHERE no_rek LIKE '%$cari%' OR nama LIKE '%$cari%' 
                                            ORDER BY no_rek ASC LIMIT $mulai, $batas") 
                                            or die('Ada kesalahan pada query siswa: '.mysqli_error($db));
              } else {
                $query = mysqli_query($db, "SELECT * FROM tbl_keluhan
                                            ORDER BY no_rek ASC LIMIT $mulai, $batas")
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
                      <td width='250'>$data[alamat]</td>
                      <td width='80'>$data[keluhan]</td>

                      <td width='100'>
                        <div class=''>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-info btn-sm' href='?page=ubah&id=$data[no_rek]'>
                            <i class='glyphicon glyphicon-edit'></i>
                          </a>";
              ?>
                          <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="proses_hapus.php?id=<?php echo $data['no_rek'];?>" onclick="return confirm('Anda yakin ingin menghapus siswa <?php echo $data['nama']; ?>?');">
                            <i class="glyphicon glyphicon-trash"></i>
                          </a>
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
            <?php 
            if (empty($_GET['hal'])) {
              $halaman_aktif = '1';
            } else {
              $halaman_aktif = $_GET['hal'];
            }
            ?>

            <a>
              Halaman <?php echo $halaman_aktif; ?> dari <?php echo $halaman; ?> | 
              Total <?php echo $jumlah; ?> data
            </a>

            <nav>
              <ul class="pagination pull-right">
              <!-- Button untuk halaman sebelumnya -->
              <?php 
              if ($halaman_aktif<='1') { ?>
                <li class="disabled">
                  <a href="" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              <?php
              } else { ?>
                <li>
                  <a href="?hal=<?php echo $page -1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              <?php
              }
              ?>

              <!-- Link halaman 1 2 3 ... -->
              <?php 
              for($x=1; $x<=$halaman; $x++) { ?>
                <li class="">
                  <a href="?hal=<?php echo $x ?>"><?php echo $x ?></a>
                </li>
              <?php
              }
              ?>

              <!-- Button untuk halaman selanjutnya -->
              <?php 
              if ($halaman_aktif>=$halaman) { ?>
                <li class="disabled">
                  <a href="" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              <?php
              } else { ?>
                <li>
                  <a href="?hal=<?php echo $page +1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              <?php
              }
              ?>
              </ul>
            </nav>
          </div>
        </div>
			</div>
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