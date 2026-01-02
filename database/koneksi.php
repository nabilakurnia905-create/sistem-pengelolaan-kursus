<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "sist_pengelola_kursus";

$koneksi = mysqli_connect($server, $username, $password, $database);

if(!$koneksi){
    die ("Koneksi gagal : " . mysqli_connect_error()); //untuk memutuskan koneksi
}

?>