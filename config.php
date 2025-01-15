<?php
$host = "localhost"; // Host database
$username = "root";  // Username database
$password = "";      // Password database
$database = "perusahaan"; // Nama database

// Membuat koneksi
$mysqli = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
