<?php
$id = $_GET['id'];
if (isset($_POST['tgl_bayar'])) {
    $tgl_bayar = $_POST['tgl_bayar'];
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $kekurangan = $_POST['kekurangan'];
    $old_jumlah_bayar = $_POST['old_jumlah_bayar'];

    $total = $old_jumlah_bayar + $jumlah_bayar;

    if ($jumlah_bayar > $kekurangan) {
        echo '<script>alert("Jumlah Bayar Melebihi Kekurangan")</script>';
    } else {
        $query = mysqli_query($koneksi, "UPDATE pembayaran SET tgl_bayar='$tgl_bayar',jumlah_bayar='$total' WHERE id_pembayaran='$id'");
        if ($query) {
            echo '<script>alert("Transaksi Pembayaran Berhasil");location.href="?page=history";</script>';
        } else {
            echo '<script>alert("Transaksi Pembayaran Gagal")</script>';
        }
    }
}
$query = mysqli_query($koneksi, "SELECT*FROM pembayaran left join petugas on petugas.id_petugas = pembayaran.id_petugas left join siswa on siswa.nisn = pembayaran.nisn left join spp on spp.id_spp = pembayaran.id_spp WHERE id_pembayaran='$id'");
$data = mysqli_fetch_array($query);
?>


<h1 class="h3 mb-h3">Transaksi Pembayaran</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <table class="table">
                        <tr>
                            <td width="200">Petugas</td>
                            <td width="1">:</td>
                            <td>
                                <input class="form-control" type="text" name="id_petugas" value="<?php echo $data['nama_petugas']; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Siswa</td>
                            <td width="1">:</td>
                            <td>
                                <input class="form-control" type="text" name="nisn" value="<?php echo $data['nama']; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tanggal Bayar</td>
                            <td width="1">:</td>
                            <td>
                                <input class="form-control" type="date" value="<?php echo $data['tgl_bayar']; ?>" disabled>
                                <input class="form-control" type="hidden" name="tgl_bayar" value="<?php echo date('Y-m-d') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="200">SPP</td>
                            <td width="1">:</td>
                            <td>
                                <input type="text" name="id_spp" class="form-control" value="<?php echo number_format($data['nominal']) . '(' . $data['tahun'] . ')'; ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Kekurangan</td>
                            <td width="1">:</td>
                            <td>
                                <input type="text" class="form-control" value="<?php echo number_format($data['nominal'] - $data['jumlah_bayar']); ?>" disabled>
                                <input type="hidden" name="kekurangan" class="form-control" value="<?php echo $data['nominal'] - $data['jumlah_bayar']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Jumlah Bayar</td>
                            <td width="1">:</td>
                            <td>
                                <input class="form-control" type="number" name="jumlah_bayar" required>
                                <input class="form-control" type="hidden" name="old_jumlah_bayar" value="<?php echo $data['jumlah_bayar'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="200"></td>
                            <td width="1"></td>
                            <td>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>