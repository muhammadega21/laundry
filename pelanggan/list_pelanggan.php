<?php require('../db.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pelanggan</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php require('../layouts/navbar.php') ?>
    <div class="container mt-4">
        <h2>Daftar Pelanggan</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPelangganModal">Tambah Pelanggan</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM pelanggan");
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $id = 1;
                foreach ($data as $row) :
                ?>
                    <tr>
                        <td><?= $id++ ?></td>
                        <td><?= $row['nama_pelanggan'] ?></td>
                        <td><?= $row['no_hp'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td class="d-flex gap-1">
                            <form action="./edit_pelanggan.php" method="get">
                                <input type="hidden" name="id" value="<?= $row['id_pelanggan'] ?>">
                                <button type="submit" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></button>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="delete" value="<?= $row['id_pelanggan'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin?')"><i class="bx bx-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php
                endforeach
                ?>
            </tbody>
        </table>
    </div>

    <?php require('tambah_pelanggan.php') ?>

    <?php

    if (@$_POST['delete']) {
        $query = "DELETE FROM pelanggan WHERE id_pelanggan=" . $_POST['delete'];
        if ($conn->query($query) === TRUE) {
            echo "<script>alert('Data berhasil dihapus!'); window.location='list_pelanggan.php';</script>";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }

    ?>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm' crossorigin='anonymous'></script>
</body>

</html>