<?php
include '../db.php';

if (isset($_POST['add_service'])) {
    $nama_layanan = $_POST['nama_layanan'];
    $harga = $_POST['harga'];

    $conn->query("INSERT INTO layanan (nama_layanan, harga) VALUES ('$nama_layanan', '$harga')");
    echo "<script>alert('Layanan berhasil ditambahkan!'); window.location='/laundry/setting/setting.php';</script>";
}

if (isset($_POST['add_stock'])) {
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];

    $conn->query("INSERT INTO inventaris (nama_barang, stok, satuan) VALUES ('$nama_barang', '$stok', '$satuan')");
    echo "<script>alert('Stok bahan berhasil ditambahkan!'); window.location='/laundry/setting/setting.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php require('../layouts/navbar.php') ?>
    <div class="container mt-4">
        <h2>Pengaturan</h2>
        <hr>

        <h3>Layanan Laundry</h3>
        <form action="" method="POST" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="nama_layanan" class="form-control" placeholder="Nama Layanan" required>
                </div>
                <div class="col-md-4">
                    <input type="number" name="harga" class="form-control" placeholder="Harga (Rp)" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="add_service" class="btn btn-primary">Tambah Layanan</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $result = $conn->query("SELECT * FROM layanan");
                    foreach ($result as $row):
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_layanan'] ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td>
                                <a href='delete_layanan.php?id=<?= $row['id_layanan'] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Hapus layanan ini?")'><i class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <hr>

        <h3>Stok Bahan Habis Pakai</h3>
        <form action="" method="POST" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" required>
                </div>
                <div class="col-md-4">
                    <input type="number" name="stok" class="form-control" placeholder="Jumlah Stok" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="satuan" class="form-control" placeholder="Satuan (kg, pcs, dll)" required>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="submit" name="add_stock" class="btn btn-primary">Tambah Stok</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM inventaris");
                    $no = 1;
                    foreach ($result as $row) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td><?= $row['stok'] ?></td>
                            <td><?= $row['satuan'] ?></td>
                            <td>
                                <a href='delete_inventaris.php?id=<?= $row['id_inventaris'] ?>' class='btn btn-danger btn-sm' onclick='return confirm("Hapus stok ini?")'><i class="bx bx-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm' crossorigin='anonymous'></script>
</body>

</html>