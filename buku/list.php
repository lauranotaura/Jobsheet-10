<?php
// buku/list.php bersifat publik (tidak memakai require auth.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';

// Ambil semua data buku dari database
$stmt = $pdo->query("SELECT * FROM buku ORDER BY id DESC");
$buku_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Daftar Buku</h2>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?>">
        <?php 
            echo $_SESSION['flash']['pesan']; 
            unset($_SESSION['flash']);
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['user_id'])): ?>
    <p><a href="tambah.php" class="btn btn-primary">+ Tambah Buku Baru</a></p>
<?php endif; ?>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <?php if (isset($_SESSION['user_id'])): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($buku_list)): ?>
            <tr>
                <td colspan="<?php echo isset($_SESSION['user_id']) ? '7' : '6'; ?>">Belum ada data buku.</td>
            </tr>
        <?php else: ?>
            <?php $no = 1; foreach ($buku_list as $buku): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                    <td><?php echo htmlspecialchars($buku['penulis']); ?></td>
                    <td><?php echo htmlspecialchars($buku['penerbit']); ?></td>
                    <td><?php echo htmlspecialchars($buku['tahun_terbit']); ?></td>
                    <td><?php echo htmlspecialchars($buku['stok']); ?></td>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <td>
                            <a href="edit.php?id=<?php echo $buku['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus.php?id=<?php echo $buku['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../includes/footer.php'; ?>