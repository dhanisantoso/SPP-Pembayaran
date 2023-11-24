<?php
include 'koneksi.php';

if (empty($_SESSION['user']['level'] == 'admin')) {
	?>
		<script>
			alert('Akses di Tolak.');
			window.history.back();
		</script>
	<?php
	}
?>

<script>
	window.print();
</script>

<table border="1" width="100%" cellpading="5" cellspacing="0">
	<tr>
		<th colspan="9">Data Siswa</th>
	</tr>
	<tr>
		<th>No</th>
		<th>NISN</th>
		<th>NIS</th>
		<th>Nama Siswa</th>
		<th>Kelas</th>
		<th>Alamat</th>
		<th>No Telepon</th>
	</tr>
	<tbody>
		<?php
		$no = 1;
		if (isset($_GET['kelas'])) {
			$kelas = $_GET['kelas'];
			$query = mysqli_query($koneksi, "SELECT*FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nama_kelas='$kelas'");
		} else {
			$query = mysqli_query($koneksi, "SELECT*FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas");
		}

		while ($data = mysqli_fetch_array($query)) {
		?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $data['nisn']; ?></td>
				<td><?php echo $data['nis']; ?></td>
				<td><?php echo $data['nama']; ?></td>
				<td><?php echo $data['nama_kelas']; ?></td>
				<td><?php echo $data['alamat']; ?></td>
				<td><?php echo $data['no_telp']; ?></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>