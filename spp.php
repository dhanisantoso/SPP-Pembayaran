<?php
if (empty($_SESSION['user']['level'] == 'admin')) {
?>
	<script>
		alert('Akses di Tolak.');
		window.history.back();
	</script>
<?php
}
?>

<h1 class="h3 mb-3" align="center"><strong>Data SPP</strong></h1>

					<div class="row">
						<div class="col-12">
							<div class="card flex-fill">
								<div class="card-header">
									<a href="?page=tambahspp" class="btn btn-success btn-sm">+ Tambah SPP</a>
								</div>
								<div class="card-body">

									<table class="table table-bordered table-striped table-hover cell-border" id="spp">
										<thead align="center">
											<tr>
												<th>No</th>
												<th>Tahun</th>
												<th>Nominal</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
                                        <?php 
											$no = 1;
                                            $query = mysqli_query($koneksi, "SELECT*FROM spp");
                                            while ($data = mysqli_fetch_array($query)) {
                                        ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $data['tahun']; ?></td>
												<td><?php echo number_format($data['nominal']); ?></td>
												<td>
													<a href="?page=edit_spp&id=<?php echo $data['id_spp']; ?>" class="btn btn-warning btn-sm rounded"><i data-feather="edit"></i></a>
													<a href="?page=hapus_spp&id=<?php echo $data['id_spp']; ?>" class="btn btn-danger btn-sm rounded"><i data-feather="trash-2"></i></a>
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
						let table = new DataTable('#spp');
					</script>