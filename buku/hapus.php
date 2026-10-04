<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM buku WHERE id = :id");
    $hapus = $stmt->execute(['id' => $id]);

    if ($hapus) {
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data buku berhasil dihapus.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menghapus data buku.'];
    }
} else {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID buku tidak valid.'];
}

header('Location: list.php');
exit;