# 🗄️ DATABASE SETUP MONEY MENTOR PRO

## 📋 LANGKAH-LANGKAH SETUP DATABASE

### 1. **Import Database ke phpMyAdmin**
- Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
- Buat database baru dengan nama: **`money_mentor_pro`**
- Import file: `database_money_mentor_pro.sql`
- Import file: `ci_sessions_table.sql`

### 2. **Konfigurasi Database CodeIgniter 3**
File konfigurasi sudah diupdate di: `application/config/database.php`

**Konfigurasi yang sudah diset:**
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'money_mentor_pro',
'dbdriver' => 'mysqli',
'char_set' => 'utf8mb4',
'dbcollat' => 'utf8mb4_unicode_ci'
```

### 3. **Autoload Libraries**
File autoload sudah dikonfigurasi di: `application/config/autoload.php`

**Libraries yang di-load otomatis:**
- `database` - Koneksi database
- `session` - Manajemen session
- `form_validation` - Validasi form

**Helpers yang di-load otomatis:**
- `url` - Helper URL
- `form` - Helper form
- `file` - Helper file
- `security` - Helper security

### 4. **Session Configuration**
Session dikonfigurasi untuk menggunakan database di: `application/config/config.php`

**Konfigurasi session:**
- Driver: `database`
- Cookie name: `money_mentor_session`
- Save path: `ci_sessions`
- Expiration: 7200 seconds (2 hours)

### 5. **Test Koneksi Database**
Setelah setup selesai, test koneksi dengan mengakses:
```
http://localhost/Project_301220026_FajarMunawar/test
```

## ✅ VERIFIKASI SETUP

### **Yang harus muncul di halaman test:**
- ✅ Database connection successful!
- 📋 List semua tabel database
- 👥 Total users: 1 (admin user)
- 📂 Total categories: 8
- 📄 Total articles: 3 (sample articles)
- ✅ Session working

### **Tabel yang harus ada:**
1. `users` - Data pengguna
2. `categories` - Kategori artikel
3. `articles` - Artikel literasi
4. `videos` - Video tutorial
5. `investment_products` - Produk investasi
6. `simulations` - Simulasi investasi
7. `webinars` - Webinar
8. `challenges` - Challenge
9. `quizzes` - Kuis
10. `ci_sessions` - Session management

## 🔧 TROUBLESHOOTING

### **Jika database connection failed:**
1. Pastikan XAMPP Apache & MySQL running
2. Pastikan database `money_mentor_pro` sudah dibuat
3. Cek username/password database
4. Pastikan file SQL sudah diimport dengan benar

### **Jika session tidak working:**
1. Pastikan tabel `ci_sessions` sudah dibuat
2. Cek permission folder application/cache
3. Restart Apache server

### **Jika ada error 404:**
1. Pastikan URL rewriting aktif
2. Cek file .htaccess
3. Pastikan mod_rewrite Apache aktif

## 🎯 SELANJUTNYA

Setelah database setup berhasil, kita akan lanjut ke:
1. **Commit 1:** Initial project setup ✅
2. **Commit 2:** Database configuration ✅
3. **Commit 3:** Basic authentication system
4. **Commit 4:** User model dan controller
5. **Commit 5:** Session management

---

**🎉 Database setup selesai! Money Mentor Pro siap dikembangkan!** 