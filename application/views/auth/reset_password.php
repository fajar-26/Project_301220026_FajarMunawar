<h2 class="text-center mb-4">
    <i class="fas fa-lock"></i> Reset Password
</h2>

<p class="text-center text-muted mb-4">
    Halo <strong><?= $user->first_name ?></strong>, silakan masukkan password baru Anda.
</p>

<?= form_open('auth/reset_password_process', ['id' => 'resetPasswordForm']) ?>
    <input type="hidden" name="token" value="<?= $token ?>">
    
    <div class="form-group">
        <label for="password" class="form-label">
            <i class="fas fa-lock"></i> Password Baru
        </label>
        <div class="input-group">
            <input type="password" 
                   class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" 
                   id="password" 
                   name="password" 
                   placeholder="Minimal 6 karakter"
                   required>
            <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                <i class="fas fa-eye" id="password-icon"></i>
            </span>
        </div>
        <div class="form-text">Password minimal 6 karakter</div>
        <?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
    </div>

    <div class="form-group">
        <label for="confirm_password" class="form-label">
            <i class="fas fa-lock"></i> Konfirmasi Password Baru
        </label>
        <div class="input-group">
            <input type="password" 
                   class="form-control <?= form_error('confirm_password') ? 'is-invalid' : '' ?>" 
                   id="confirm_password" 
                   name="confirm_password" 
                   placeholder="Ulangi password baru"
                   required>
            <span class="input-group-text password-toggle" onclick="togglePassword('confirm_password')">
                <i class="fas fa-eye" id="confirm_password-icon"></i>
            </span>
        </div>
        <?= form_error('confirm_password', '<div class="invalid-feedback">', '</div>') ?>
        <div id="password-match" class="form-text"></div>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Simpan Password Baru
    </button>
<?= form_close() ?>

<div class="text-center mt-4">
    <a href="<?= base_url('auth') ?>" class="text-decoration-none">
        <i class="fas fa-arrow-left"></i> Kembali ke Login
    </a>
</div>

<script>
// Toggle password visibility
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + '-icon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Check password match
document.getElementById('confirm_password').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    const feedback = document.getElementById('password-match');
    
    if (confirmPassword) {
        if (password === confirmPassword) {
            feedback.innerHTML = '<span style="color: #27ae60;"><i class="fas fa-check"></i> Password cocok</span>';
            this.classList.remove('is-invalid');
        } else {
            feedback.innerHTML = '<span style="color: #e74c3c;"><i class="fas fa-times"></i> Password tidak cocok</span>';
            this.classList.add('is-invalid');
        }
    }
});

// Auto focus pada input password
document.getElementById('password').focus();
</script> 