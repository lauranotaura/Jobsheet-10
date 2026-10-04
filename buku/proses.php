<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$judul        = trim($_POST['judul'] ?? '');
$penulis      = trim($_POST['penulis'] ?? '');
$penerbit     = trim($_POST['penerbit'] ?? '');
$tahun_terbit = (int) ($_POST['tahun_terbit'] ?? 0);
$stok         = (int) ($_POST['stok'] ?? 0);

if ($judul === '' || $penulis === '' || $penerbit === '' || $tahun_terbit <= 0 || $stok < 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Harap isi semua bidang input dengan benar.'];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok) 
     VALUES (:judul, :penulis, :penerbit, :tahun_terbit, :stok)"
);

$simpan = $stmt->execute([
    'judul'        => $judul,
    'penulis'      => $penulis,
    'penerbit'     => $penerbit,
    'tahun_terbit' => $tahun_terbit,
    'stok'         => $stok
]);

if ($simpan) {
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan.'];
    header('Location: list.php');
} else {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menambahkan buku.'];
    header('Location: tambah.php');
}
exit;