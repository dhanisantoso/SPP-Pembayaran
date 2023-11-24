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
    $query = mysqli_query($koneksi, "DELETE FROM spp WHERE id_spp=$id");

    if ($query) {
        echo '<script>alert("Data SPP Berhasil Dihapus");location.href="?page=spp";</script>';
    }
}
?>