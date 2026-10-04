<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../includes/koneksi.php';

// Ambil data input dari form login
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Cari data pengguna di database berdasarkan username
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifikasi keberadaan user dan kecocokan password hash
if ($user && password_verify($password, $user['password'])) {
    // Simpan identitas penting ke session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama']    = $user['nama'];
    $_SESSION['role']    = $user['role'];
    
    // Redirect ke halaman beranda
    header('Location: ../index.php');
    exit;
}

// Jika gagal, set pesan flash umum demi keamanan
$_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username atau password salah.'];
header('Location: login.php');
exit;