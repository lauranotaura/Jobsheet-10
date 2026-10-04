<?php
// Guard clause: Memeriksa status login pengguna.
// Wajib di-require/include di baris PALING ATAS halaman yang terkunci
// (sebelum header.php atau kode yang menghasilkan output HTML apa pun).

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika session user_id belum ada, alihkan pengunjung ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}