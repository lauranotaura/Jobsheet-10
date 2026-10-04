<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID buku tidak ditemukan.'];
    header('Location: list.php');
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data buku tidak ditemukan.'];
    header('Location: list.php');
    exit;
}

$page_title = "Edit Buku";
include __DIR__ . '/../includes/header.php';
?>

<h2>Edit Data Buku</h2>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?>">
        <?php 
            echo $_SESSION['flash']['pesan']; 
            unset($_SESSION['flash']);
        ?>
    </div>
<?php endif; ?>

<form action="proses_edit.php" method="POST" class="form-container">
    <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">

    <div class="form-group">
        <label for="judul">Judul Buku:</label>
        <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($buku['judul']); ?>" required>
    </div>

    <div class="form-group">
        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" value="<?php echo htmlspecialchars($buku['penulis']); ?>" required>
    </div>

    <div class="form-group">
        <label for="penerbit">Penerbit:</label>
        <input type="text" id="penerbit" name="penerbit" value="<?php echo htmlspecialchars($buku['penerbit']); ?>" required>
    </div>

    <div class="form-group">
        <label for="tahun_terbit">Tahun Terbit:</label>
        <input type="number" id="tahun_terbit" name="tahun_terbit" min="1900" max="<?php echo date('Y'); ?>" value="<?php echo htmlspecialchars($buku['tahun_terbit']); ?>" required>
    </div>

    <div class="form-group">
        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" min="0" value="<?php echo htmlspecialchars($buku['stok']); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="list.php" class="btn btn-secondary">Batal</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>