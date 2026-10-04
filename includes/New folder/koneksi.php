<?php
// Konfigurasi Database PostgreSQL
$host     = 'localhost';
$port     = '5432';
$dbname   = 'simpus_mini';
$user     = 'postgres';
$password = 'postgres'; // Sesuaikan dengan password PostgreSQL lokal kamu

try {
    // Data Source Name (DSN) untuk PostgreSQL
    $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
    
    // Opsi konfigurasi PDO
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lempar exception jika ada error SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Ambil data dalam bentuk array asosiatif
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Gunakan prepared statements asli
    ];

    // Membuat instance PDO
    $pdo = new PDO($dsn, $user, $password, $options);

} catch (PDOException $e) {
    // Tampilkan pesan error dan hentikan eksekusi jika koneksi gagal
    die("Koneksi database gagal: " . $e->getMessage());
}