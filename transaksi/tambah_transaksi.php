<?php

if (isset($_POST['add_transaction'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_layanan = $_POST['id_layanan'];
    $jumlah = $_POST['jumlah'];

    $result = $conn->query("SELECT harga FROM layanan WHERE id_layanan = $id_layanan");
    $layanan = $result->fetch_assoc();
    $harga = $layanan['harga'];

    $total = $harga * $jumlah;

    $conn->query("INSERT INTO transaksi (id_pelanggan, id_layanan, jumlah, total, tanggal_transaksi) 
                  VALUES ('$id_pelanggan', '$id_layanan', '$jumlah', '$total', NOW())");

    $inventaris = $conn->query("SELECT * FROM inventaris");
    if ($inventaris && $inventaris->num_rows > 0) {
        while ($row = $inventaris->fetch_assoc()) {
            if ($id_layanan == 1) {
                $stok_dipakai = $jumlah;
            } elseif ($id_layanan == 2) {
                $stok_dipakai = $jumlah * 0.5;
            } else {
                $stok_dipakai = $jumlah * 1.5;
            }

            $conn->query("UPDATE inventaris SET stok = stok - $stok_dipakai WHERE id_inventaris = {$row['id_inventaris']}");
        }
    }
    echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location='list_transaksi.php';</script>";
}

?>

<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransactionModalLabel">Tambah Transaksi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_pelanggan" class="form-label">Pelanggan</label>
                        <select name="id_pelanggan" id="id_pelanggan" class="form-select" required>
                            <option value="">Pilih Pelanggan</option>
                            <?php
                            $pelanggan = $conn->query("SELECT * FROM pelanggan");
                            foreach ($pelanggan as $row) {
                                echo "<option value='{$row['id_pelanggan']}'>{$row['nama_pelanggan']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_layanan" class="form-label">Layanan</label>
                        <select name="id_layanan" id="id_layanan" class="form-select" required>
                            <option value="">Pilih Layanan</option>
                            <?php
                            $layanan = $conn->query("SELECT * FROM layanan");
                            foreach ($layanan as $row) {
                                echo "<option value='{$row['id_layanan']}'>{$row['nama_layanan']} (Rp " . number_format($row['harga'], 0, ',', '.') . ")</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah (Kg / Satuan)</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_transaction" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>