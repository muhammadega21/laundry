<?php

if (isset($_POST['add_pelanggan'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO pelanggan (nama_pelanggan, no_hp, alamat) VALUES ('$nama_pelanggan', '$no_hp', '$alamat')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='list_pelanggan.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<div class="modal fade" id="addPelangganModal" tabindex="-1" aria-labelledby="addPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPelangganModalLabel">Tambah Transaksi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_pelanggan" class="mb-2">Nama</label>
                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="no_hp" class="mb-2">No HP</label>
                        <input type="number" name="no_hp" id="no_hp" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="alamat" class="mb-2">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_pelanggan" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>