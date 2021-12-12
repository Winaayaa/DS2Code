<?php
session_start();
require "koneksi.php";

$username = $_POST["username"];
$password = $_POST["password"];

$hasil = mysqli_query($conn, "select * from tb_user WHERE username='$username' 
&& password='$password'");
$row = mysqli_fetch_array($hasil);
if ($hasil) {
    if (isset ($row['username']) && isset ($row['password']) && 
    ($row['username'] == $username && $row['password'] == $password)) {
        header("location:../home.php");
    } else {
        header("location:../sign-in"); 
    }
}
?>
