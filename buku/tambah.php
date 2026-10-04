<?php
// Baris wajib paling atas untuk mengunci halaman
require __DIR__ . '/../includes/auth.php';

$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';
?>

<h2>Tambah Buku Baru</h2>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?>">
        <?php 
            echo $_SESSION['flash']['pesan']; 
            unset($_SESSION['flash']);
        ?>
    </div>
<?php endif; ?>

<form action="proses_tambah.php" method="POST" class="form-container">
    <div class="form-group">
        <label for="judul">Judul Buku:</label>
        <input type="text" id="judul" name="judul" required>
    </div>

    <div class="form-group">
        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" required>
    </div>

    <div class="form-group">
        <label for="penerbit">Penerbit:</label>
        <input type="text" id="penerbit" name="penerbit" required>
    </div>

    <div class="form-group">
        <label for="tahun_terbit">Tahun Terbit:</label>
        <input type="number" id="tahun_terbit" name="tahun_terbit" min="1900" max="<?php echo date('Y'); ?>" required>
    </div>

    <div class="form-group">
        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" min="0" value="1" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Buku</button>
    <a href="list.php" class="btn btn-secondary">Batal</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>