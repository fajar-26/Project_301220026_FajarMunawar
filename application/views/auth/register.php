<h2 class="text-center mb-4">
    <i class="fas fa-user-plus"></i> Daftar Akun
</h2>

<?= form_open('auth/register_process', ['id' => 'registerForm']) ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name" class="form-label">
                    <i class="fas fa-user"></i> Nama Depan *
                </label>
                <input type="text" 
                       class="form-control <?= form_error('first_name') ? 'is-invalid' : '' ?>" 
                       id="first_name" 
                       name="first_name" 
                       value="<?= set_value('first_name') ?>"
                       placeholder="Masukkan nama depan"
                       required>
                <?= form_error('first_name', '<div class="invalid-feedback">', '</div>') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name" class="form-label">
                    <i class="fas fa-user"></i> Nama Belakang *
                </label>
                <input type="text" 
                       class="form-control <?= form_error('last_name') ? 'is-invalid' : '' ?>" 
                       id="last_name" 
                       name="last_name" 
                       value="<?= set_value('last_name') ?>"
                       placeholder="Masukkan nama belakang"
                       required>
                <?= form_error('last_name', '<div class="invalid-feedback">', '</div>') ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="username" class="form-label">
            <i class="fas fa-at"></i> Username *
        </label>
        <input type="text" 
               class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>" 
               id="username" 
               name="username" 
               value="<?= set_value('username') ?>"
               placeholder="Pilih username unik"
               required>
        <div class="form-text">Username akan digunakan untuk login</div>
        <?= form_error('username', '<div class="invalid-feedback">', '</div>') ?>
        <div id="username-feedback" class="form-text"></div>
    </div>

    <div class="form-group">
        <label for="email" class="form-label">
            <i class="fas fa-envelope"></i> Email *
        </label>
        <input type="email" 
               class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" 
               id="email" 
               name="email" 
               value="<?= set_value('email') ?>"
               placeholder="Masukkan email Anda"
               required>
        <?= form_error('email', '<div class="invalid-feedback">', '</div>') ?>
        <div id="email-feedback" class="form-text"></div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone" class="form-label">
                    <i class="fas fa-phone"></i> Nomor Telepon
                </label>
                <input type="tel" 
                       class="form-control <?= form_error('phone') ? 'is-invalid' : '' ?>" 
                       id="phone" 
                       name="phone" 
                       value="<?= set_value('phone') ?>"
                       placeholder="081234567890">
                <?= form_error('phone', '<div class="invalid-feedback">', '</div>') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="birth_date" class="form-label">
                    <i class="fas fa-calendar"></i> Tanggal Lahir
                </label>
                <input type="date" 
                       class="form-control <?= form_error('birth_date') ? 'is-invalid' : '' ?>" 
                       id="birth_date" 
                       name="birth_date" 
                       value="<?= set_value('birth_date') ?>">
                <?= form_error('birth_date', '<div class="invalid-feedback">', '</div>') ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="investment_experience" class="form-label">
            <i class="fas fa-chart-line"></i> Pengalaman Investasi *
        </label>
        <select class="form-control <?= form_error('investment_experience') ? 'is-invalid' : '' ?>" 
                id="investment_experience" 
                name="investment_experience" 
                required>
            <option value="">Pilih pengalaman investasi</option>
            <option value="beginner" <?= set_select('investment_experience', 'beginner') ?>>Pemula (Baru mulai belajar)</option>
            <option value="intermediate" <?= set_select('investment_experience', 'intermediate') ?>>Menengah (Sudah pernah investasi)</option>
            <option value="advanced" <?= set_select('investment_experience', 'advanced') ?>>Mahir (Sudah berpengalaman)</option>
        </select>
        <?= form_error('investment_experience', '<div class="invalid-feedback">', '</div>') ?>
    </div>

    <div class="form-group">
        <label for="password" class="form-label">
            <i class="fas fa-lock"></i> Password *
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
            <i class="fas fa-lock"></i> Konfirmasi Password *
        </label>
        <div class="input-group">
            <input type="password" 
                   class="form-control <?= form_error('confirm_password') ? 'is-invalid' : '' ?>" 
                   id="confirm_password" 
                   name="confirm_password" 
                   placeholder="Ulangi password Anda"
                   required>
            <span class="input-group-text password-toggle" onclick="togglePassword('confirm_password')">
                <i class="fas fa-eye" id="confirm_password-icon"></i>
            </span>
        </div>
        <?= form_error('confirm_password', '<div class="invalid-feedback">', '</div>') ?>
        <div id="password-match" class="form-text"></div>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
        <label class="form-check-label" for="terms">
            Saya setuju dengan <a href="#" target="_blank">Syarat & Ketentuan</a> dan <a href="#" target="_blank">Kebijakan Privasi</a>
        </label>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-user-plus"></i> Daftar Sekarang
    </button>
<?= form_close() ?>

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
    Sudah punya akun? 
    <a href="<?= base_url('auth') ?>">Login Sekarang</a>
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

// Check username availability
document.getElementById('username').addEventListener('blur', function() {
    const username = this.value;
    const feedback = document.getElementById('username-feedback');
    
    if (username.length >= 3) {
        fetch('<?= base_url('auth/check_username') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'username=' + encodeURIComponent(username)
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                feedback.innerHTML = '<span style="color: #e74c3c;"><i class="fas fa-times"></i> Username sudah digunakan</span>';
                this.classList.add('is-invalid');
            } else {
                feedback.innerHTML = '<span style="color: #27ae60;"><i class="fas fa-check"></i> Username tersedia</span>';
                this.classList.remove('is-invalid');
            }
        });
    }
});

// Check email availability
document.getElementById('email').addEventListener('blur', function() {
    const email = this.value;
    const feedback = document.getElementById('email-feedback');
    
    if (email && email.includes('@')) {
        fetch('<?= base_url('auth/check_email') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'email=' + encodeURIComponent(email)
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                feedback.innerHTML = '<span style="color: #e74c3c;"><i class="fas fa-times"></i> Email sudah terdaftar</span>';
                this.classList.add('is-invalid');
            } else {
                feedback.innerHTML = '<span style="color: #27ae60;"><i class="fas fa-check"></i> Email tersedia</span>';
                this.classList.remove('is-invalid');
            }
        });
    }
});

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

function socialLogin(provider) {
    alert('Fitur registrasi dengan ' + provider + ' akan segera hadir!');
}

// Auto focus pada input pertama
document.getElementById('first_name').focus();
</script> 