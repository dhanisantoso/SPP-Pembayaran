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
	if (isset($_POST['tahun'])) {

		$tahun = $_POST['tahun'];
		$nominal = $_POST['nominal'];
		$query_cek = mysqli_query($koneksi, "SELECT * FROM spp WHERE tahun = '$tahun' AND id_spp != '$id' ");
		$cek = mysqli_num_rows($query_cek);
		if ($cek > 0) {
			echo '<script>alert("Data SPP Sudah Ada");location.href="?page=spp";</script>';
		} else {

			$query = mysqli_query($koneksi, "UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp = $id");

			if ($query) {
				echo '<script>alert("Ubah Data Berhasil");location.href="?page=spp";</script>';
			}
		}
	}
	$query = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp=$id");
	$data =  mysqli_fetch_array($query);

?>
	<h1 class="h3 mb-3" align="center"><strong>Ubah SPP</strong></h1>

	<div class="row">
		<div class="col-12">
			<div class="card flex-fill">
				<div class="card-body">
					<form action="" method="post">
						<div class="mb-3">
							<label class="form-label">Tahun</label>
							<input type="number" value="<?php echo $data['tahun']; ?>" name="tahun" class="form-control" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Nominal</label>
							<input type="number" value="<?php echo $data['nominal']; ?>" name="nominal" class="form-control" required>
						</div>

						<div class="mb-3" style="float: right;">
							<button class="btn btn-primary">Simpan</button>
							<button typy="reset" class="btn btn-danger">Reset</button>
							<a href="?page=spp" class="btn btn-warning"> kembali</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>