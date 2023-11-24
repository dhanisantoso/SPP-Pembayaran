<?php
if (isset($_POST['nama_petugas'])) {
	$nama_petugas = $_POST['nama_petugas'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$level = $_POST['level'];

	$query = mysqli_query($koneksi, "INSERT INTO petugas (nama_petugas,username,password,level) VALUES ('$nama_petugas','$username','$password','$level')");

	if ($query) {
		echo '<script>alert("Tambah Data Berhasil");location.href="?page=petugas";</script>';
	}
}
if (empty($_SESSION['user']['level'] == 'admin')) {
?>
	<script>
		alert('Akses di Tolak.');
		window.history.back();
	</script>
<?php
}
?>


<h1 class="h3 mb-3" align="center"><strong>Tambah Petugas</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-body">
				<form action="" method="post">
					<div class="mb-3">
						<label class="form-label">Nama Petugas</label>
						<input type="text" name="nama_petugas" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Username</label>
						<input type="text" name="username" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Level</label>
						<select name="level" class="form-select">
							<option value="admin">Admin</option>
							<option value="petugas">Petugas</option>
						</select>
					</div>
					<div class="mb-3" style="float: right;">
						<button class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-danger">Reset</button>
						<a href="?page=petugas" class="btn btn-warning"> kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>