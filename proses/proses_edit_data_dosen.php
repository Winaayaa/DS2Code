<?php

require "koneksi.php";

$id = $_POST['id_user'];
$nip = $_POST['nip'];
$nama = $_POST['nm_dosen'];
$tempatlahir = $_POST['tempat_lahir'];
$tgllahir = $_POST['tgl_lahir'];
$prodi = $_POST['prodi'];
$alamat = $_POST['alamat'];


$update = mysqli_query($conn, "UPDATE tb_dosen SET nip='$nip', nm_dosen='$nama', 
tempat_lahir='$tempatlahir', tgl_lahir='$tgllahir', prodi='$prodi', 
alamat='$alamat' WHERE id_user = '$id'");
if($update) {
    echo '<script>window.location="../dosen";</script>';
} else {
    echo '<script>alert("Mohon maaf, data dosen tidak dapat diperbarui.");</script>';
    echo '<script>window.location="../dosen";</script>';
}
?>