<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'laundry';

$conn = mysqli_connect($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
