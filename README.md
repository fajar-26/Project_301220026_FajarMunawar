# 🚀 Money Mentor Pro

**Platform Literasi Finansial dan Investasi Berbasis Web**

[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-orange.svg)](https://codeigniter.com/)
[![PHP](https://img.shields.io/badge/PHP-7.4+-blue.svg)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-green.svg)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

## 📖 **Deskripsi**

Money Mentor Pro adalah platform edukasi finansial dan investasi berbasis web yang dikembangkan berdasarkan penelitian jurnal "Rancang Bangun Literasi Finansial dan Investasi Money Mentor Pro". Platform ini bertujuan untuk meningkatkan literasi keuangan masyarakat Indonesia melalui konten edukasi yang mudah diakses dan simulasi investasi virtual.

## ✨ **Fitur Utama**

### 🎓 **Literasi Finansial**
- 📚 Artikel edukasi finansial terlengkap
- 🎥 Video tutorial investasi
- 📊 Infografis dan materi visual
- 🎤 Webinar dengan ahli finansial

### 💰 **Simulasi Investasi**
- 🧮 Kalkulator investasi interaktif
- 📈 Simulasi portofolio virtual
- 📊 Analisis risiko investasi
- 📋 Tracking progress investasi

### 🏆 **Challenge & Gamification**
- 🎯 Challenge bulanan investasi
- 🧠 Kuis pengetahuan finansial
- 🏅 Sistem reward dan achievement
- 📊 Leaderboard kompetisi

### 👥 **Komunitas**
- 👨‍💼 Forum diskusi investor
- 🤝 Mentoring dengan ahli
- 📢 Notifikasi real-time
- 📱 Responsive design

## 🛠️ **Teknologi**

### **Backend**
- **Framework:** CodeIgniter 3
- **Language:** PHP 7.4+
- **Database:** MySQL 5.7+
- **Architecture:** MVC Pattern

### **Frontend**
- **Framework:** Bootstrap 5
- **Icons:** Font Awesome 6
- **JavaScript:** Vanilla JS + jQuery
- **Design:** Responsive & Modern UI

### **Database**
- **Tables:** 20+ tables dengan relasi kompleks
- **Views:** Reporting dan analytics
- **Stored Procedures:** Operasi kompleks
- **Triggers:** Maintenance otomatis

## 🚀 **Instalasi**

### **Prerequisites**
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache/Nginx web server
- Git

### **Quick Start**

1. **Clone Repository**
```bash
git clone https://github.com/fajar-26/Project_301220026_FajarMunawar.git
cd Project_301220026_FajarMunawar
```

2. **Setup Database**
```bash
# Import database
mysql -u root -p < database_money_mentor_pro.sql

# Atau gunakan file batch (Windows)
install_database.bat
```

3. **Configure CodeIgniter**
```php
// Edit application/config/database.php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => 'your_password',
    'database' => 'money_mentor_pro',
    'dbdriver' => 'mysqli'
);
```

4. **Start Application**
```bash
# Jika menggunakan XAMPP
# Akses: http://localhost/Project_301220026_FajarMunawar
```

### **Default Login**
- **Username:** `admin`
- **Password:** `admin123`
- **Email:** `admin@moneymentorpro.com`

## 📊 **Struktur Database**

### **Tabel Utama**
- `users` - Data pengguna
- `categories` - Kategori artikel
- `articles` - Artikel literasi finansial
- `videos` - Video tutorial
- `investment_products` - Produk investasi
- `simulations` - Simulasi investasi
- `webinars` - Webinar edukasi
- `challenges` - Challenge bulanan
- `quizzes` - Kuis pengetahuan

### **Fitur Database**
- ✅ **20 Tabel** dengan relasi kompleks
- ✅ **Views** untuk reporting
- ✅ **Stored Procedures** untuk operasi kompleks
- ✅ **Triggers** untuk maintenance otomatis
- ✅ **Indexes** untuk optimasi performance
- ✅ **Sample Data** untuk testing

## 🎯 **Fitur Berdasarkan Jurnal**

### **1. Sistem Autentikasi**
- Login/Register dengan validasi
- Remember token untuk session
- Email verification
- Password reset

### **2. Manajemen Konten**
- Artikel dengan kategori
- Video tutorial
- Webinar dan event
- Challenge bulanan

### **3. Simulasi Investasi**
- Kalkulator investasi
- Simulasi portofolio virtual
- Tracking progress
- Analisis risiko

### **4. Sistem Pembelajaran**
- Kuis dan assessment
- Progress tracking
- Bookmark konten
- Riwayat membaca

## 📈 **Screenshots**

### **Landing Page**
![Landing Page](screenshots/landing-page.png)

### **Dashboard**
![Dashboard](screenshots/dashboard.png)

### **Simulasi Investasi**
![Simulasi](screenshots/simulation.png)

## 🔧 **Development**

### **Project Structure**
```
Project_301220026_FajarMunawar/
├── application/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   └── views/
├── system/
├── database_money_mentor_pro.sql
├── install_database.bat
├── test_database.php
└── README.md
```

### **Database Documentation**
- Lihat file `DATABASE_DOCUMENTATION.md` untuk dokumentasi lengkap database

## 📝 **Testing**

### **Database Test**
```bash
# Test koneksi database
php test_database.php
```

### **Manual Testing**
1. Akses halaman utama
2. Test registrasi user baru
3. Test login dengan akun admin
4. Test fitur literasi dan simulasi

## 🤝 **Kontribusi**

Kontribusi selalu diterima! Silakan:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 **Lisensi**

Project ini dilisensikan di bawah [MIT License](LICENSE).

## 👨‍💻 **Author**

**Fajar Munawar**
- GitHub: [@fajar-26](https://github.com/fajar-26)
- Email: admin@moneymentorpro.com

## 🙏 **Acknowledgments**

- **PT. Impactbyte Teknologi Edukasi** - Inspirasi dan konteks penelitian
- **CodeIgniter Team** - Framework yang luar biasa
- **Bootstrap Team** - UI framework yang responsive
- **Font Awesome** - Icon library yang lengkap

## 📞 **Support**

Jika Anda memiliki pertanyaan atau masalah:

- 📧 Email: admin@moneymentorpro.com
- 🐛 Issues: [GitHub Issues](https://github.com/fajar-26/Project_301220026_FajarMunawar/issues)
- 📖 Documentation: Lihat file dokumentasi di repository

---

## 📊 **Statistik Project**

![GitHub stars](https://img.shields.io/github/stars/fajar-26/Project_301220026_FajarMunawar)
![GitHub forks](https://img.shields.io/github/forks/fajar-26/Project_301220026_FajarMunawar)
![GitHub issues](https://img.shields.io/github/issues/fajar-26/Project_301220026_FajarMunawar)
![GitHub pull requests](https://img.shields.io/github/issues-pr/fajar-26/Project_301220026_FajarMunawar)

---

**© 2024 Money Mentor Pro - Platform Literasi Finansial dan Investasi**

*Dikembangkan berdasarkan penelitian jurnal "Rancang Bangun Literasi Finansial dan Investasi Money Mentor Pro"* 