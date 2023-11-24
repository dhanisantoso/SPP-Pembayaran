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

<h1 class="h3 mb-3" align="center"><strong>Petugas</strong></h1>

					<div class="row">
						<div class="col-12">
							<div class="card flex-fill">
								<div class="card-header">
									<a href="?page=tambahpetugas" class="btn btn-success btn-sm">+ Tambah Petugas</a>
								</div>
								<div class="card-body">
									<table class="table table-bordered table-striped table-hover cell-border" id="petugas">
										<thead align="center">
											<tr>
												<th>No</th>
												<th>Nama Petugas</th>
												<th>Username</th>
												<th>Level</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
                                        <?php 
											$no = 1;
                                            $query = mysqli_query($koneksi, "SELECT*FROM petugas");
                                            while ($data = mysqli_fetch_array($query)) {
                                        ?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $data['nama_petugas']; ?></td>
												<td><?php echo $data['username']; ?></td>
												<td><?php echo $data['level']; ?></td>
												<td>
													<a href="?page=editpetugas&id=<?php echo $data['id_petugas']; ?>" class="btn btn-warning btn-sm rounded"><i data-feather="edit"></i></a>
													<a href="?page=hapus_petugas&id=<?php echo $data['id_petugas']; ?>" class="btn btn-danger btn-sm rounded"><i data-feather="trash-2"></i></a>
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
						let table = new DataTable('#petugas');
					</script>