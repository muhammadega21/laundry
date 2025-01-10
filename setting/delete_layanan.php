<?php
include '../db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $conn->query("DELETE FROM layanan WHERE id_layanan = $id");
}
echo "<script>alert('Layanan berhasil dihapus!'); window.location='/laundry/setting/setting.php';</script>";
