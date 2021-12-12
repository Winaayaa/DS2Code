<?php
session_start();
require "koneksi.php";

$username = $_POST["username"];
$password = $_POST["password"];

if ($_SESSION['username'] == $username && $_SESSON['password'] == $password) {
    header("location:../home.php");
}
else {
    header("location:../home.php"); 
}

?>
