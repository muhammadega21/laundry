<?php
include '../db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $conn->query("DELETE FROM transaksi WHERE id = $id");
}
echo "<script>alert('Transaksi berhasil dihapus!'); window.location='list_transaksi.php';</script>";
