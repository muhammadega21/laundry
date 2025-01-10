<?php
include '../db.php';



$transaksi = $conn->query("SELECT t.*, p.nama_pelanggan AS nama_pelanggan, l.nama_layanan 
                           FROM transaksi t
                           JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                           JOIN layanan l ON t.id_layanan = l.id_layanan
                           ORDER BY t.tanggal_transaksi DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require('../layouts/navbar.php') ?>
    <div class="container mt-4">
        <h2>Daftar Transaksi</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTransactionModal">Tambah Transaksi</button>

        <!-- Tabel Transaksi -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Layanan</th>
                    <th>Jumlah (Kg/Satuan)</th>
                    <th>Total (Rp)</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;

                foreach ($transaksi as $row):

                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_pelanggan']; ?></td>
                        <td><?= $row['nama_layanan']; ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td><?= number_format($row['total'], 0, ',', '.'); ?></td>
                        <td><?= date_format(date_create($row['tanggal_transaksi']), 'l, d F Y'); ?></td>
                        <td><a href='delete_transaksi.php?id=<?= $row['id'] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Hapus transaksi ini?")'>Hapus</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php require('tambah_transaksi.php') ?>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm' crossorigin='anonymous'></script>
</body>

</html>