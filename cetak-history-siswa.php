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

<h1 class="h3 mb-3" align="center"><strong>History Pembayaran</strong></h1>

<div class="row">
    <div class="col-12">
        <div class="card flex-fill">

            <div class="card-body">

                <table border="1" width="100%" cellpadding="5" cellspacing="0">
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