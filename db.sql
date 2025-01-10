CREATE TABLE `pemilik` (
    `id_pemilik` INT PRIMARY KEY AUTO_INCREMENT,
    `nama_pemilik` VARCHAR(255),
    `username` VARCHAR(255),
    `password` VARCHAR(255)
);

CREATE TABLE `pegawai` (
    `id_pegawai` INT PRIMARY KEY AUTO_INCREMENT,
    `nama_pegawai` VARCHAR(255),
    `no_hp` VARCHAR(255),
    `alamat` VARCHAR(255),
    `id_pemilik` INT,
    FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`)
);

CREATE TABLE `pelanggan` (
    `id_pelanggan` INT PRIMARY KEY AUTO_INCREMENT,
    `nama_pelanggan` VARCHAR(255),
    `no_hp` VARCHAR(255),
    `alamat` VARCHAR(255)
);

CREATE TABLE `layanan` (
    `id_layanan` INT PRIMARY KEY AUTO_INCREMENT,
    `nama_layanan` VARCHAR(255),
    `harga` DECIMAL(10, 2)
);

INSERT INTO
    `layanan` (
        id_layanan,
        nama_layanan,
        harga
    )
VALUES (1, 'Cuci Kiloan', 7000),
    (2, 'Setrika', 4000),
    (3, 'Express', 10000);

CREATE TABLE transaksi (
    id_transaksi int PRIMARY KEY AUTO_INCREMENT,
    id_pelanggan int,
    id_layanan int,
    tanggal_transaksi date,
    jumlah int,
    total decimal(10, 2),
    status_pembayaran boolean DEFAULT 0,
    FOREIGN KEY (id_pelanggan) REFERENCES pelanggan (id_pelanggan),
    FOREIGN KEY (id_layanan) REFERENCES layanan (id_layanan)
);

CREATE TABLE `inventaris` (
    `id_inventaris` INT PRIMARY KEY AUTO_INCREMENT,
    `nama_barang` VARCHAR(255),
    `stok` INT,
    `satuan` VARCHAR(255)
);