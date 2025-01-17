<?php
include '../db.php';

$filter_harian = $_GET['filter_harian'] ?? 'today';

if ($filter_harian === 'this_week') {
    $query_harian = $conn->query("
        SELECT t.*, p.nama_pelanggan AS nama_pelanggan, l.nama_layanan
        FROM transaksi t
        JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
        JOIN layanan l ON t.id_layanan = l.id_layanan
        WHERE YEARWEEK(t.tanggal_transaksi, 1) = YEARWEEK(CURDATE(), 1)
        ORDER BY t.tanggal_transaksi DESC
    ");
} else {
    $tanggal_hari_ini = date('Y-m-d');
    $query_harian = $conn->query("
        SELECT t.*, p.nama_pelanggan AS nama_pelanggan, l.nama_layanan
        FROM transaksi t
        JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
        JOIN layanan l ON t.id_layanan = l.id_layanan
        WHERE DATE(t.tanggal_transaksi) = '$tanggal_hari_ini'
        ORDER BY t.tanggal_transaksi DESC
    ");
}
$total_harian = 0;
foreach ($query_harian as $row) {
    $total_harian += $row['total'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php require('../layouts/navbar.php') ?>
    <div class="container mt-4">
        <div class="d-flex gap-1 align-items-center justify-content-between">
            <h2>Laporan Harian</h2>
            <span><a href="./laporan_bulanan.php" class="btn btn-success btn-sm"><i class='bx bx-transfer'></i> Bulanan</a></span>
        </div>
        <form method="GET" class="mb-3 d-flex gap-2 align-items-center">
            <label for="filter_harian">Pilih Opsi:</label>
            <select name="filter_harian" id="filter_harian" class="form-select w-25" onchange="this.form.submit()">
                <option value="today" <?= $filter_harian === 'today' ? 'selected' : ''; ?>>Hari Ini</option>
                <option value="this_week" <?= $filter_harian === 'this_week' ? 'selected' : ''; ?>>Minggu Ini</option>
            </select>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Jumlah</th>
                        <th>Total (Rp)</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($query_harian as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_pelanggan']; ?></td>
                            <td><?= $row['nama_layanan']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td><?= number_format($row['total'], 0, ',', '.'); ?></td>
                            <td><?= date_format(date_create($row['tanggal_transaksi']), 'l, d F Y'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h5>Total Pendapatan Hari Ini: Rp <?= number_format($total_harian, 0, ',', '.'); ?></h5>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm' crossorigin='anonymous'></script>
</body>

</html>