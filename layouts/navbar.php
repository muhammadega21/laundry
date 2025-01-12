<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/laundry">Kaisa Laundry</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'list_pelanggan.php') ? 'active' : ''; ?>" href="/laundry/pelanggan/list_pelanggan.php">Pelanggan</a></li>
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'list_transaksi.php') ? 'active' : ''; ?>" href="/laundry/transaksi/list_transaksi.php">Transaksi</a></li>
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'laporan_harian.php' || basename($_SERVER['PHP_SELF']) == 'laporan_bulanan.php') ? 'active' : ''; ?>" href="/laundry/laporan/laporan_harian.php">Laporan</a></li>
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'setting.php') ? 'active' : ''; ?>" href="/laundry/setting/setting.php">Pengaturan</a></li>
            </ul>
        </div>
    </div>
</nav>