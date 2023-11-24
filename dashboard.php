<?php
if ($level == 'admin' || $level == 'petugas') {


?>

<h1 class="h3 mb-3" align="center"><strong>Dashboard</strong></h1>

					<div class="row">
						<div class="col-12">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Jumlah Petugas</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
                                                    <?php
                                                    $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM petugas");
                                                    $data = mysqli_fetch_assoc($query);
                                                    echo $data['total'];
                                                    ?>
                                                </h1>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Jumlah Kelas</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="home"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
                                                    <?php
                                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kelas");
                                                        $data = mysqli_fetch_assoc($query);
                                                        echo $data['total'];
                                                    ?>
                                                </h1>
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Jumlah Siswa</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
                                                    <?php
                                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa");
                                                        $data = mysqli_fetch_assoc($query);
                                                        echo $data['total'];
                                                    ?>
                                                </h1>
											</div>
										</div>

									</div>
									<div class="col-sm-3">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">SPP Tahun Ini</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="book"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
													RP.
                                                    <?php
														$tahun= date("Y");
                                                        $query = mysqli_query($koneksi, "SELECT * FROM spp WHERE tahun='$tahun'");
                                                        $data = mysqli_fetch_assoc($query);
                                                        echo number_format($data['nominal'], 2, ',', '.');
                                                    ?>
                                                </h1>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> 

<?php
}else{

?>
<h1 class="h3 mb-3" align="center"><strong>History Pembayaran</strong></h1>

<div class="row">
	<div class="col-12">
		<div class="card flex-fill">
			<div class="card-body">

				<table class="table table-bordered table-striped table-hover cell-border" id="history">
					<thead align="center">
						<tr>
							<th>No</th>
							<th>Petugas</th>
							<th>NISN</th>
							<th>Nama Siswa</th>
							<th>Tanggal Bayar</th>
							<th>SPP</th>
							<th>Jumlah Bayar</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$no = 1;
						$id_nisn = $_SESSION['user']['nisn'];
						$query = mysqli_query($koneksi, "SELECT*FROM pembayaran left join petugas on petugas.id_petugas = pembayaran.id_petugas left join siswa on siswa.nisn = pembayaran.nisn left join spp on spp.id_spp = pembayaran.id_spp WHERE pembayaran.nisn='$id_nisn'");
						while ($data = mysqli_fetch_array($query)) {
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nama_petugas']; ?></td>
							<td><?php echo $data['nisn']; ?></td>
							<td><?php echo $data['nama']; ?></td>
							<td><?php echo $data['tgl_bayar']; ?></td>
							<td><?php echo number_format($data['nominal']); ?></td>
							<td><?php echo number_format($data['jumlah_bayar']); ?></td>
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
<?php
}
?>