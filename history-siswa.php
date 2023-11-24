<?php
if (empty($_SESSION['user']['level'])) {
?>
	<script>
		alert('Akses di Tolak.');
		window.history.back();
	</script>
<?php
}
?>
<h1 class="h3 mb-3" align="center"><strong>History Pembayaran</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-header">
				<a href="cetak-history-siswa.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-success btn-sm" <?php echo ($level == 'petugas' ? 'hidden' : '') ?>><i data-feather="printer"></i> Print</a>
			</div>
			<div class="card-body">

				<table class="table table-bordered table-striped table-hover cell-border" id="history">
					<thead align="center">
						<tr>
							<th>No</th>
							<th>Petugas</th>
							<th>Nama Siswa</th>
							<th>Tanggal Bayar</th>
							<th>SPP</th>
							<th>Jumlah Bayar</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $no = 1;
						$query = mysqli_query($koneksi, "SELECT*FROM pembayaran left join petugas on petugas.id_petugas = pembayaran.id_petugas left join siswa on siswa.nisn = pembayaran.nisn left join spp on spp.id_spp = pembayaran.id_spp WHERE pembayaran.nisn='$id'");
                        }
						while ($data = mysqli_fetch_array($query)) {
						?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $data['nama_petugas']; ?></td>
								<td><?php echo $data['nama']; ?></td>
								<td><?php echo $data['tgl_bayar']; ?></td>
								<td><?php echo number_format($data['nominal']) . '(' . $data['tahun'] . ')'; ?></td>
								<td><?php echo number_format($data['jumlah_bayar']); ?></td>
								<td>
									<?php
									if ($data['jumlah_bayar'] < $data['nominal']) {
										echo 'Kurang';
									} else {
										echo 'Lunas';
									}
									?>
								</td>
								<td>
									<?php
									if ($data['nominal'] == $data['jumlah_bayar']) {
									?>
										<a href="?page=hapus_pembayaran&id=<?php echo $data['id_pembayaran']; ?>" class="btn btn-danger btn-sm rounded" <?php echo ($level == 'petugas' ? 'hidden' : '') ?>><i data-feather="trash-2"></i></a>
										<a href="#" class="btn btn-success btn-sm rounded"><i data-feather="check"></i></a>
									<?php
									} else {
									?>
										<a href="?page=hapus_pembayaran&id=<?php echo $data['id_pembayaran']; ?>" class="btn btn-danger btn-sm rounded" <?php echo ($level == 'petugas' ? 'hidden' : '') ?>><i data-feather="trash-2"></i></a>
										<a href="?page=lunasi&id=<?php echo $data['id_pembayaran']; ?>" class="btn btn-warning btn-sm rounded"><i data-feather="book"></i></a>
									<?php
									}
									?>
								</td>
							</tr>
						<?php
							$no++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	let table = new DataTable('#history');
</script>