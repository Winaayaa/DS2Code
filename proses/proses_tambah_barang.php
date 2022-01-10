<?php

require "koneksi.php";

$kodebarang = $_POST['kode_barang'];
$namabarang = $_POST['nama_barang'];
$keterangan = $_POST['keterangan'];
$stokbarang = $_POST['stok'];


if(empty($kodebarang) || $kodebarang == "") {
    echo '<script>alert("Data tidak boleh kosong.");</script>';
    echo '<script>window.location="../barang";</script>';
} else {
    $select = mysqli_query($conn, "SELECT kode_barang FROM tb_barang WHERE kode_barang='$kodebarang'");
    
    $hasil = mysqli_fetch_array($select);
    if (isset($hasil['kode_barang'])) {
        echo '<script>alert("Data kode barang telah ada.");</script>';
        echo '<script>window.location="../barang";</script>';
    } else {
        $sql = mysqli_query($conn, "INSERT INTO tb_barang (kode_barang, nama_barang, keterangan, stok) 
        VALUES ('$kodebarang', '$namabarang', '$keterangan', '$stokbarang')");
        if($sql) {
            echo '<script>alert("Data berhasil ditambahkan.");</script>';
            echo '<script>window.location="../barang";</script>';
        } else {
            echo '<script>alert("Mohon maaf, data gagal ditambah.");</script>';
            echo '<script>window.location="../barang";</script>';
        }
    }
}

?>