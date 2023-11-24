<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn='$id'");

if ($query) {
    echo '<script>alert("Data Berhasil Dihapus");location.href="?page=siswa";</script>';
}