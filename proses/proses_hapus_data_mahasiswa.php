<?php

require "koneksi.php";

$id = $_POST['id_user'];
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$tempatlahir = $_POST['tempat_lahir'];
$tgllahir = $_POST['tgl_lahir'];
$kelas = $_POST['kelas'];
$prodi = $_POST['prodi'];
$alamat = $_POST['alamat'];


$update = mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE id_user = '$id'");
if($update) {
    echo '<script>window.location="../mhs";</script>';
} else {
    echo '<script>alert("Mohon maaf, data mahasiswa tidak dapat dihapus.");</script>';
    echo '<script>window.location="../mhs";</script>';
}
?>