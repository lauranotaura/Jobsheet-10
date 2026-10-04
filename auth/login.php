<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Alihkan ke Beranda jika pengguna sudah login
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Login";
include __DIR__ . '/../includes/header.php';
?>

<h2>Login Petugas</h2>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-<?php echo $_SESSION['flash']['type']; ?>">
        <?php 
            echo $_SESSION['flash']['pesan']; 
            unset($_SESSION['flash']);
        ?>
    </div>
<?php endif; ?>

<form action="proses_login.php" method="POST" class="form-container">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-secondary">Belum punya akun? Registrasi</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>