<?php
session_start();
require "koneksi.php";

$brg = $_POST['barang'];
$mk  = $_POST['matkul'];

if (empty($_POST['wkt_kembali'])) {
    echo "<script> alert('Waktu pengembalian harus diisi.'); </script>";
    echo "<script> window.location = '../pinjam'; </script>"; 
}
else {
    $wkt_kembali = $_POST['wkt_kembali'];
}

$select = mysqli_query($conn, "SELECT id FROM tb_user 
WHERE username='$_SESSION[username]'");
$hasil = mysqli_fetch_array($select);

if ($hasil) {
    $select1 = mysqli_query($conn, "SELECT barang FROM tb_peminjaman WHERE barang='$brg'
    && (status = 1 || status = 2)");
    $hasil1 =mysqli_fetch_array($select1);
    if ($hasil1)  {
        echo "<script> alert('Peminjaman gagal ditambahkan, barang telah dipinjam.'); </script>";
        echo "<script> window.location = '../pinjam'; </script>"; 
    }
    else {
        $input = mysqli_query($conn, "INSERT INTO tb_peminjaman (barang,user,status,matakuliah,waktu_pengembalian) 
        VALUES ($brg,$hasil[id],1,'$mk','$wkt_kembali')");
        if ($input) {
        echo "<script> alert('Peminjaman berhasil ditambahkan.'); </script>";
        echo "<script> window.location = '../pinjam'; </script>"; 
        }
        else {
            echo "<script> alert('Peminjaman gagal ditambahkan.'); </script>";
            echo "<script> window.location = '../pinjam'; </script>"; 
        }
    }
}
else {
    echo "<script> alert('Peminjaman gagal ditambahkan.'); </script>";
    echo "<script> window.location = '../pinjam'; </script>"; 
}

?>