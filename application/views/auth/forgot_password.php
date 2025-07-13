<h2 class="text-center mb-4">
    <i class="fas fa-key"></i> Lupa Password
</h2>

<p class="text-center text-muted mb-4">
    Masukkan email Anda yang terdaftar. Kami akan mengirimkan link untuk reset password.
</p>

<?= form_open('auth/forgot_password_process', ['id' => 'forgotPasswordForm']) ?>
    <div class="form-group">
        <label for="email" class="form-label">
            <i class="fas fa-envelope"></i> Email
        </label>
        <input type="email" 
               class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" 
               id="email" 
               name="email" 
               value="<?= set_value('email') ?>"
               placeholder="Masukkan email Anda"
               required>
        <?= form_error('email', '<div class="invalid-feedback">', '</div>') ?>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-paper-plane"></i> Kirim Link Reset
    </button>
<?= form_close() ?>

<div class="text-center mt-4">
    <a href="<?= base_url('auth') ?>" class="text-decoration-none">
        <i class="fas fa-arrow-left"></i> Kembali ke Login
    </a>
</div>

<div class="auth-footer">
    Belum punya akun? 
    <a href="<?= base_url('auth/register') ?>">Daftar Sekarang</a>
</div>

<script>
// Auto focus pada input email
document.getElementById('email').focus();
</script> 