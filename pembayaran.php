<?php
if (isset($_POST['nisn'])) {
    $id_petugas = $_SESSION['user']['id_petugas'];
    $nisn = $_POST['nisn'];
    $tgl_bayar = $_POST['tgl_bayar'];
    $id_spp = $_POST['id_spp'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    $spp = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp='$id_spp'");
    $nominal = mysqli_fetch_array($spp);

    $cek = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE nisn='$nisn' AND id_spp='$id_spp'");

    if (mysqli_num_rows($cek) > 0) {
        echo '<script>alert("Siswa Telah Membayar SPP Tahun ini")</script>';
    }else {
        if ($jumlah_bayar > $nominal['nominal']) {
            echo '<script>alert("Jumlah Bayar Melebihi Nominal SPP")</script>';
        } else {
            $query = mysqli_query($koneksi, "INSERT INTO pembayaran(id_petugas,nisn,tgl_bayar,id_spp,jumlah_bayar) values ('$id_petugas','$nisn','$tgl_bayar','$id_spp','$jumlah_bayar')");
            if ($query) {
                echo '<script>alert("Entri Pembayaran Berhasil");location.href="?page=history";</script>';
            } else {
                echo '<script>alert("Entri Pembayaran Gagal")</script>';
            }
        }
    }
}
?>


<h1 class="h3 mb-h3">Entri Data Pembayaran</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <table class="table">
                        <tr>
                            <td width="200">Siswa</td>
                            <td width="1">:</td>
                            <td>
                                <select name="nisn" class="form-select">
                                    <?php
                                    $p = mysqli_query($koneksi, "SELECT*FROM siswa");
                                    while ($siswa = mysqli_fetch_array($p)) {
                                    ?>
                                        <option value="<?php echo $siswa['nisn']; ?>"><?php echo $siswa['nama']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Tanggal Bayar</td>
                            <td width="1">:</td>
                            <td>
                                <input class="form-control" type="date" name="tgl_bayar" required>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">SPP</td>
                            <td width="1">:</td>
                            <td>
                                <select name="id_spp" class="form-select">
                                    <?php
                                    $p = mysqli_query($koneksi, "SELECT*FROM spp");
                                    while ($spp = mysqli_fetch_array($p)) {
                                    ?>
                                        <option value="<?php echo $spp['id_spp']; ?>"><?php echo number_format($spp['nominal']) . '(' . $spp['tahun'] . ')'; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="200">Jumlah Bayar</td>
                            <td width="1">:</td>
                            <td>
                                <input class="form-control" type="number" name="jumlah_bayar" required>
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