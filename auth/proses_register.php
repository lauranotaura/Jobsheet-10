<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pola alih jalur: Jika pengguna sudah login, langsung arahkan ke Beranda
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Registrasi Petugas";
include __DIR__ . '/../includes/header.php';
?>

<h2>Registrasi Petugas Baru</h2>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?>">
        <?php 
            echo $_SESSION['flash']['pesan']; 
            unset($_SESSION['flash']);
        ?>
    </div>
<?php endif; ?>

<form action="proses_register.php" method="POST" class="form-container">
    <div class="form-group">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" required>
    </div>

    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
        <label for="password">Password (min. 6 karakter):</label>
        <input type="password" id="password" name="password" minlength="6" required>
    </div>

    <button type="submit" class="btn btn-primary">Daftar</button>
    <a href="login.php" class="btn btn-secondary">Sudah punya akun? Login</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>