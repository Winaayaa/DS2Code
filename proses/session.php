<?php
session_start(); //untuk menandakan bahwa kita menggunakan session
require "koneksi.php";
if (empty($_SESSION['username'])) { //$_session username untuk melindungi username
    echo "<script> window.location='sign-in/form_signin.php'; </script>";
} else {
    $hasil = mysqli_query($conn, "select * from tb_user WHERE username='$_SESSION[username]'");
    $row = mysqli_fetch_array($hasil);
} 
?>