<?php
if (empty($_SESSION['user']['level'] == 'admin')) {
?>
	<script>
		alert('Akses di Tolak.');
		window.history.back();
	</script>
<?php
} else {
	$id = $_GET['id'];
	if (isset($_POST['nama_kelas'])) {
		$nama_kelas = $_POST['nama_kelas'];
		$kompetensi_keahlian = $_POST['kompetensi_keahlian'];
		$query_cek = mysqli_query($koneksi, "SELECT * FROM kelas WHERE nama_kelas = '$nama_kelas' AND kompetensi_keahlian ='$kompetensi_keahlian'AND id_kelas != '$id' ");
		$cek = mysqli_num_rows($query_cek);
		if ($cek > 0) {
			echo '<script>alert("Data Kelas Sudah Ada");location.href="?page=kelas";</script>';
		} else {

			$query = mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama_kelas',kompetensi_keahlian='$kompetensi_keahlian' WHERE id_kelas='$id'");

			if ($query) {
				echo '<script>alert("Edit Data Berhasil");location.href="?page=kelas";</script>';
			}
		}
	}
	$query = mysqli_query($koneksi, "SELECT*FROM kelas WHERE id_kelas='$id'");
	$data = mysqli_fetch_array($query);

?>
	<h1 class="h3 mb-3" align="center"><strong>Edit Kelas</strong></h1>

	<div class="row">
		<div class="col-12">
			<div class="card flex-fill">
				<div class="card-body">
					<form action="" method="post">
						<div class="mb-3">
							<label class="form-label">Kelas</label>
							<input type="text" name="nama_kelas" class="form-control" value="<?php echo $data['nama_kelas']; ?>" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Kompetensi Keahlian</label>
							<input type="text" name="kompetensi_keahlian" class="form-control" value="<?php echo $data['kompetensi_keahlian']; ?>" required>
						</div>

						<div class="mb-3" style="float: right;">
							<button class="btn btn-primary">Simpan</button>
							<button typy="reset" class="btn btn-danger">Reset</button>
							<a href="?page=kelas" class="btn btn-warning"> kembali</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>