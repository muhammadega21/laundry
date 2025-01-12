<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9' crossorigin='anonymous'>
    <link rel="stylesheet" href="../style.css">
</head>

<body>


    <?php
    // Ambil ID pelanggan dari URL
    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo "<script>alert('ID pelanggan tidak ditemukan!'); window.location='list_pelanggan.php';</script>";
        exit;
    }

    $result = $conn->query("SELECT * FROM pelanggan WHERE id_pelanggan = $id");
    $pelanggan = $result->fetch_assoc();

    if (!$pelanggan) {
        echo "<script>alert('Data pelanggan tidak ditemukan!'); window.location='list_pelanggan.php';</script>";
        exit;
    }

    if (isset($_POST['submit'])) {
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];

        $update = $conn->query("UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', no_hp = '$no_hp', alamat = '$alamat' WHERE id_pelanggan = $id");

        if ($update) {
            echo "<script>alert('Data pelanggan berhasil diperbarui!'); window.location='list_pelanggan.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data pelanggan!');</script>";
        }
    }
    ?>

    <div class="container mt-4">
        <h2>Edit Pelanggan</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nama_pelanggan" class="mb-2">Nama</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="<?php echo $pelanggan['nama_pelanggan']; ?>" required>
            </div>
            <div class="form-group mt-3">
                <label for="no_hp" class="mb-2">No HP</label>
                <input type="number" name="no_hp" id="no_hp" class="form-control" value="<?php echo $pelanggan['no_hp']; ?>" required>
            </div>
            <div class=" form-group mt-3">
                <label for="alamat" class="mb-2">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required><?php echo $pelanggan['alamat']; ?></textarea>
            </div>
            <div class=" mt-3">
                <button type="submit" name="submit" class="btn btn-success">Update</button>
                <a href="list_pelanggan.php" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm' crossorigin='anonymous'></script>
</body>

</html>