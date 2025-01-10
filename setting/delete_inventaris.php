<?php
include '../db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $conn->query("DELETE FROM inventaris WHERE id_inventaris = $id");
}
echo "<script>alert('Stok berhasil dihapus!'); window.location='/laundry/setting/setting.php';</script>";
