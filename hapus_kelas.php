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
    $query = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas='$id'");

    if ($query) {
        echo '<script>alert("Data Berhasil Dihapus");location.href="?page=kelas";</script>';
    }
}
?>