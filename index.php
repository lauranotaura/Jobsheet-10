<?php
// index.php bersifat publik (tidak memerlukan require auth.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = "Beranda - SIMPUS-Mini";
include __DIR__ . '/includes/header.php';
?>

<div class="hero-section">
    <h2>Selamat Datang di SIMPUS-Mini</h2>
    <p>Sistem Informasi Manajemen Perpustakaan Mini berbasis PHP & PostgreSQL.</p>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="alert alert-success">
            Halo, <strong><?php echo htmlspecialchars($_SESSION['nama']); ?></strong>! Anda login sebagai <em><?php echo htmlspecialchars($_SESSION['role']); ?></em>.
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            Anda masuk sebagai <strong>Tamu</strong>. Silakan <a href="auth/login.php">login</a> untuk mengakses fitur pengolahan data buku dan anggota.
        </div>
    <?php endif; ?>
</div>

<div class="features-grid">
    <div class="card">
        <h3>Daftar Buku</h3>
        <p>Lihat katalog buku yang tersedia di perpustakaan.</p>
        <a href="buku/list.php" class="btn btn-primary">Lihat Buku</a>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="card">
            <h3>Kelola Anggota</h3>
            <p>Kelola data pendaftaran dan daftar anggota aktif.</p>
            <a href="anggota/list.php" class="btn btn-primary">Daftar Anggota</a>
        </div>
        <div class="card">
            <h3>Tambah Buku</h3>
            <p>Tambahkan koleksi buku baru ke sistem.</p>
            <a href="buku/tambah.php" class="btn btn-secondary">Tambah Buku</a>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>