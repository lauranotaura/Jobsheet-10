<?php
// Pastikan sesi diperiksa/dimulai sebelum dihancurkan
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menghapus seluruh data sesi (user_id, nama, role, dll.)
session_destroy();

// Mengalihkan pengguna kembali ke halaman Login
header('Location: login.php');
exit;