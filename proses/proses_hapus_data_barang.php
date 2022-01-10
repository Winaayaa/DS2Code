<?php

require "koneksi.php";

$kodebarang = $_POST['kode_barang'];
$namabarang = $_POST['nama_barang'];
$keterangan = $_POST['keterangan'];

//echo $namabarang . "<br>";
//echo $keterangan . "<br>";

$update = mysqli_query($conn, "DELETE FROM tb_barang WHERE kode_barang = '$kodebarang'");
if($update) {
    echo '<script>window.location="../barang";</script>';
} else {
    echo '<script>alert("Mohon maaf, data barang tidak dapat dihapus.");</script>';
    echo '<script>window.location="../barang";</script>';
}
?>