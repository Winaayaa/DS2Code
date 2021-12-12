<?php
session_start();
require "koneksi.php";

$username = $_POST["username"];
$password = $_POST["password"];

//echo $username . "-" . $password;

$hasil = mysqli_query($conn, "select * from tb_user WHERE username='$username' 
&& password='$password'");
$row = mysqli_fetch_array($hasil);
if ($hasil) {
    if (isset ($row['username']) && isset ($row['password']) && 
    ($row['username'] == $username && $row['password'] == $password)) {
        echo "<script> window.location='../index.php'; </script>";
        $_SESSION['username']=$row['username'];
        //header("location:../index.php");
    } else {
        echo "<script> window.location='../sign-in/form_signin.php'; </script>";
        //header("location:../sign-in/form_signin.php"); 
        echo "<script> alert('Mohon maaf username atau password yang Anda masukkan salah') </script>";
    }
}
?>
