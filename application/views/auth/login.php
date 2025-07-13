<h2 class="text-center mb-4">
    <i class="fas fa-sign-in-alt"></i> Login
</h2>

<?= form_open('auth/login', ['id' => 'loginForm']) ?>
    <div class="form-group">
        <label for="email" class="form-label">
            <i class="fas fa-envelope"></i> Email atau Username
        </label>
        <input type="text" 
               class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" 
               id="email" 
               name="email" 
               value="<?= set_value('email') ?>"
               placeholder="Masukkan email atau username Anda"
               required>
        <?= form_error('email', '<div class="invalid-feedback">', '</div>') ?>
    </div>

    <div class="form-group">
        <label for="password" class="form-label">
            <i class="fas fa-lock"></i> Password
        </label>
        <div class="input-group">
            <input type="password" 
                   class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" 
                   id="password" 
                   name="password" 
                   placeholder="Masukkan password Anda"
                   required>
            <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                <i class="fas fa-eye" id="password-icon"></i>
            </span>
        </div>
        <?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember" name="remember">
        <label class="form-check-label" for="remember">
            Ingat saya
        </label>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-sign-in-alt"></i> Login
    </button>
<?= form_close() ?>

<div class="text-center mt-3">
    <a href="<?= base_url('auth/forgot_password') ?>" class="text-decoration-none">
        <i class="fas fa-key"></i> Lupa Password?
    </a>
</div>

<div class="divider">
    <span>atau</span>
</div>

<div class="social-login">
    <a href="#" class="social-btn" onclick="socialLogin('google')">
        <i class="fab fa-google"></i> Google
    </a>
    <a href="#" class="social-btn" onclick="socialLogin('facebook')">
        <i class="fab fa-facebook-f"></i> Facebook
    </a>
</div>

<div class="auth-footer">
    Belum punya akun? 
    <a href="<?= base_url('auth/register') ?>">Daftar Sekarang</a>
</div>

<script>
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

function socialLogin(provider) {
    // Implementasi social login akan dibuat nanti
    alert('Fitur login dengan ' + provider + ' akan segera hadir!');
}

// Auto focus pada input email
document.getElementById('email').focus();
</script> 