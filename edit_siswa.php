<?php
$id = $_GET['id'];
if (isset($_POST['nisn'])) {
	$nisn_old = $_POST['nisn_old'];
	$nis_old = $_POST['nis_old'];
	$nisn = $_POST['nisn'];
	$nis = $_POST['nis'];
	$nama = $_POST['nama'];
	$id_kelas = $_POST['id_kelas'];
	$alamat = $_POST['alamat'];
	$no_telp = $_POST['no_telp'];
	$password = md5($_POST['password']);

	$cek_nisn = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn!='$nisn_old' AND nisn='$nisn'");
	$cek_nis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis!='$nis_old' AND nis='$nis'");
	$cek1 = mysqli_num_rows($cek_nisn);
	$cek2 = mysqli_num_rows($cek_nis);

	if ($cek1 == 0 && $cek2 == 0) {
		if ($_POST['password'] == '') {
			$query = mysqli_query($koneksi, "UPDATE siswa SET nisn='$nisn',nis='$nis',nama='$nama',id_kelas='$id_kelas',alamat='$alamat',no_telp='$no_telp' WHERE nisn='$id'");
			if ($query) {
				echo '<script>alert("Edit Data Berhasil");location.href="?page=siswa";</script>';
			}
		} else {
			$query = mysqli_query($koneksi, "UPDATE siswa SET nisn='$nisn',nis='$nis',nama='$nama',id_kelas='$id_kelas',alamat='$alamat',no_telp='$no_telp',password='$password' WHERE nisn='$id'");
			if ($query) {
				echo '<script>alert("Edit Data Berhasil");location.href="?page=siswa";</script>';
			}
		}
	} elseif ($cek1 != 0) {
		echo '<script>alert("NISN Sudah Digunakan");</script>';
	} elseif ($cek2 != 0) {
		echo '<script>alert("NIS Sudah Digunakan");</script>';
	}
}

$query = mysqli_query($koneksi, "SELECT*FROM siswa WHERE nisn='$id'");
$data = mysqli_fetch_array($query);

?>


<h1 class="h3 mb-3" align="center"><strong>Edit Siswa</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-body">
				<form action="" method="post">
					<div class="mb-3">
						<label class="form-label">NISN</label>
						<input type="hidden" name="nisn_old" class="form-control" value="<?php echo $data['nisn']; ?>">
						<input type="text" name="nisn" class="form-control" value="<?php echo $data['nisn']; ?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label">NIS</label>
						<input type="hidden" name="nis_old" class="form-control" value="<?php echo $data['nis']; ?>">
						<input type="text" name="nis" class="form-control" value="<?php echo $data['nis']; ?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Nama Siswa</label>
						<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Kelas</label>
						<select name="id_kelas" class="form-select" required>
							<?php
							$query = mysqli_query($koneksi, "SELECT * FROM kelas");
							while ($kelas = mysqli_fetch_array($query)) {
							?>

								<option value="<?php echo $kelas['id_kelas']; ?>" <?php if ($data['id_kelas'] == $kelas['id_kelas']) {
																						echo 'selected';
																					}
																					?>>
									<?php echo $kelas['nama_kelas']; ?> - <?php echo $kelas['kompetensi_keahlian']; ?></option>

							<?php
							}
							?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Alamat</label>
						<input type="text" name="alamat" class="form-control" value="<?php echo $data['alamat']; ?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label">No Telepon</label>
						<input type="number" class="form-control" name="no_telp" value="<?php echo $data['no_telp'] ?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input type="password" name="password" class="form-control">
					</div>

					<div class="mb-3" style="float: right;">
						<button class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-danger">Reset</button>
						<a href="?page=siswa" class="btn btn-warning"> kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>