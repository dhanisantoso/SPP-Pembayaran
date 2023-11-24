<?php
if (isset($_POST['nisn'])) {
	$nisn = $_POST['nisn'];
	$nis = $_POST['nis'];
	$nama = $_POST['nama'];
	$id_kelas = $_POST['id_kelas'];
	$alamat = $_POST['alamat'];
	$no_telp = $_POST['no_telp'];
	$password = md5($_POST['password']);


	$cek = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
	$cek1 = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
	$cek2 = mysqli_num_rows($cek);
	$cek3 = mysqli_num_rows($cek1);

	if ($cek2 > 0) {
		echo '<script>alert("NISN Sudah Digunakan");</script>';
	} elseif ($cek3 > 0) {
		echo '<script>alert("NIS Sudah Digunakan");</script>';
	} else {
		$query = mysqli_query($koneksi, "INSERT INTO siswa (nisn,nis,nama,id_kelas,alamat,no_telp,password) VALUES ('$nisn','$nis','$nama','$id_kelas','$alamat','$no_telp','$password')");
		if ($query) {
			echo '<script>alert("Tambah Data Berhasil");location.href="?page=siswa";</script>';
		}
	}
}
?>


<h1 class="h3 mb-3" align="center"><strong>+ Tambah Siswa</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-body">
				<form action="" method="post">
					<div class="mb-3">
						<label class="form-label">NISN</label>
						<input type="text" name="nisn" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">NIS</label>
						<input type="text" name="nis" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Nama Siswa</label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Kelas</label>
						<select name="id_kelas" class="form-select" required>
							<?php
							$query = mysqli_query($koneksi, "SELECT * FROM kelas");
							while ($kelas = mysqli_fetch_array($query)) {
							?>

								<option value="<?php echo $kelas['id_kelas']; ?>"> <?php echo $kelas['nama_kelas']; ?> - <?php echo $kelas['kompetensi_keahlian']; ?></option>

							<?php
							}
							?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Alamat</label>
						<input type="text" name="alamat" class="form-control" required>
					</div>
					<div class="mb-3">
						<label class="form-label">No Telepon</label>
						<input type="text" class="form-control" name="no_telp" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>

					<div class="mb-3" style="float: right;">
						<button class="btn btn-primary">Simpan</button>
						<button typy="reset" class="btn btn-danger">Reset</button>
						<a href="?page=siswa" class="btn btn-warning"> kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>