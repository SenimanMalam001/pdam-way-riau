<?php include('../views/tamplates/header.php'); ?>
<?php include('../views/tamplates/navbar-keluhan.php'); ?>

<!-- Comments Form -->
<div class="section">
<div class="container">
	<div class="row">
		<!-- Blog Post -->
		<div class="col-sm-12">
			<div class="blog-post blog-single-post">
				<div class="single-post-title">
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
					<h3>Tulis Keluhan Anda</h3>
					<br>
				</div>
				<div class="comment-form-wrapper">
					<form class="form-horizontal" action="crud_costumer/proses_simpan.php" method="POST">
						<div class="form-group">
						 	<label for="comment-name"><i class="glyphicon glyphicon-user"></i> <b>No Rek Air</b></label>
							<input class="form-control" name="no_rek" maxlength="12" autocomplete="off" required>
						</div>
						<div class="form-group">
						 	<label for="comment-name"><i class="glyphicon glyphicon-user"></i> <b>Nama</b></label>
							<input class="form-control" name="nama" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="comment-email"><i class="glyphicon glyphicon-envelope"></i> <b>Email</b></label>
							<input class="form-control" name="email" autocomplete="off" required>
						</div>
						<div class="form-group">
						 	<label for="comment-name"><i class="glyphicon glyphicon-user"></i> <b>No Hp</b></label>
							<input class="form-control" name="no_hp" autocomplete="off" maxlength="13"  required>
						</div>
						<div class="form-group">
							<label for="comment-message"><i class="glyphicon glyphicon-comment"></i> <b>Alamat</b></label>
							<textarea class="form-control" name="alamat" rows="3" required></textarea>
						</div>
						<div class="form-group">
							<label for="comment-message"><i class="glyphicon glyphicon-comment"></i> <b>Keluhan</b></label>
							<textarea class="form-control" name="keluhan" rows="3" required></textarea>
						</div>
						<div class="form-group">
							<button type="submit" name="simpan" class="btn btn-large pull-right">Kirim</button>
						</div>
						<div class="clearfix"></div>
					</form>
				</div>
			</div>	
		</div>	
	</div>
</div>
</div>						
<!-- End Comment Form -->
<?php include('../views/tamplates/footer.php'); ?>