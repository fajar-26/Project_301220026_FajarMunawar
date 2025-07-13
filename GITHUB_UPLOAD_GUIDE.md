# 🚀 Panduan Upload ke GitHub

## 📋 **Langkah-langkah Upload Project Money Mentor Pro ke GitHub**

### **Prerequisites**
- Git terinstal di komputer Anda
- Akun GitHub aktif
- Repository GitHub sudah dibuat

---

## 🛠️ **Langkah 1: Install Git**

### **Windows**
1. Download Git dari: https://git-scm.com/download/win
2. Install dengan pengaturan default
3. Restart terminal/command prompt

### **Verifikasi Instalasi**
```bash
git --version
```

---

## 🔧 **Langkah 2: Konfigurasi Git**

### **Set User Info**
```bash
git config --global user.name "Fajar Munawar"
git config --global user.email "your.email@example.com"
```

### **Verifikasi Konfigurasi**
```bash
git config --list
```

---

## 📁 **Langkah 3: Inisialisasi Repository**

### **Masuk ke Directory Project**
```bash
cd C:\xampp\htdocs\Project_301220026_FajarMunawar
```

### **Inisialisasi Git**
```bash
git init
```

---

## 📝 **Langkah 4: Tambahkan File ke Git**

### **Cek Status**
```bash
git status
```

### **Tambahkan Semua File**
```bash
git add .
```

### **Atau Tambahkan File Tertentu**
```bash
git add README.md
git add database_money_mentor_pro.sql
git add application/
git add system/
```

---

## 💾 **Langkah 5: Commit Pertama**

### **Buat Commit**
```bash
git commit -m "Initial commit: Money Mentor Pro - Platform Literasi Finansial dan Investasi

- Database structure with 20+ tables
- CodeIgniter 3 framework setup
- Complete documentation
- Sample data and test files"
```

---

## 🔗 **Langkah 6: Hubungkan ke GitHub**

### **Tambahkan Remote Repository**
```bash
git remote add origin https://github.com/fajar-26/Project_301220026_FajarMunawar.git
```

### **Verifikasi Remote**
```bash
git remote -v
```

---

## 🚀 **Langkah 7: Push ke GitHub**

### **Set Branch Main**
```bash
git branch -M main
```

### **Push ke GitHub**
```bash
git push -u origin main
```

---

## 🔐 **Langkah 8: Autentikasi GitHub**

### **Jika Diminta Login**
- Masukkan username GitHub Anda
- Untuk password, gunakan **Personal Access Token**

### **Cara Buat Personal Access Token**
1. Buka GitHub.com
2. Klik profile picture → Settings
3. Scroll ke bawah → Developer settings
4. Personal access tokens → Tokens (classic)
5. Generate new token
6. Pilih scopes: `repo`, `workflow`
7. Copy token dan simpan dengan aman

---

## 📋 **Langkah 9: Verifikasi Upload**

### **Cek Repository GitHub**
1. Buka: https://github.com/fajar-26/Project_301220026_FajarMunawar
2. Pastikan semua file sudah terupload
3. Cek README.md tampil dengan benar

---

## 🔄 **Langkah 10: Update Selanjutnya**

### **Setelah Mengubah File**
```bash
# Cek perubahan
git status

# Tambahkan perubahan
git add .

# Commit perubahan
git commit -m "Update: deskripsi perubahan"

# Push ke GitHub
git push
```

---

## 🛠️ **Troubleshooting**

### **Error: Repository not found**
- Pastikan URL repository benar
- Pastikan Anda memiliki akses ke repository
- Cek apakah repository sudah dibuat di GitHub

### **Error: Authentication failed**
- Gunakan Personal Access Token, bukan password
- Pastikan token memiliki permission yang cukup
- Regenerate token jika perlu

### **Error: Permission denied**
- Pastikan Anda adalah owner atau collaborator repository
- Cek pengaturan repository di GitHub

### **Error: Large file**
- File database mungkin terlalu besar
- Gunakan Git LFS atau split file besar
- Atau exclude file besar dari Git

---

## 📊 **File yang Akan Diupload**

### **Core Files**
- ✅ `README.md` - Dokumentasi project
- ✅ `LICENSE` - Lisensi MIT
- ✅ `.gitignore` - File yang diignore
- ✅ `database_money_mentor_pro.sql` - Database structure
- ✅ `install_database.bat` - Script instalasi database
- ✅ `test_database.php` - Test koneksi database

### **CodeIgniter Files**
- ✅ `application/` - Folder aplikasi CodeIgniter
- ✅ `system/` - Folder sistem CodeIgniter
- ✅ `index.php` - Entry point aplikasi

### **Documentation**
- ✅ `GITHUB_UPLOAD_GUIDE.md` - Panduan ini
- ✅ `DATABASE_DOCUMENTATION.md` - Dokumentasi database

---

## 🎯 **Setelah Upload Berhasil**

### **1. Setup GitHub Pages (Optional)**
1. Buka repository di GitHub
2. Settings → Pages
3. Source: Deploy from a branch
4. Branch: main
5. Folder: / (root)
6. Save

### **2. Add Topics**
1. Edit repository
2. Add topics: `codeigniter`, `php`, `mysql`, `financial-literacy`, `investment`, `education`

### **3. Add Description**
```
Platform Literasi Finansial dan Investasi berbasis web dengan CodeIgniter 3. Dikembangkan berdasarkan penelitian jurnal untuk meningkatkan literasi keuangan masyarakat Indonesia.
```

### **4. Enable Issues & Wiki**
1. Settings → Features
2. Enable Issues
3. Enable Wiki
4. Enable Discussions (optional)

---

## 📞 **Support**

Jika mengalami masalah:

1. **Cek Error Message** - Baca pesan error dengan teliti
2. **Google Search** - Cari solusi di internet
3. **GitHub Help** - Dokumentasi resmi GitHub
4. **Stack Overflow** - Forum developer

---

## 🎉 **Selamat!**

Project Money Mentor Pro Anda sudah berhasil diupload ke GitHub!

**Repository URL:** https://github.com/fajar-26/Project_301220026_FajarMunawar.git

**Next Steps:**
1. Share repository dengan teman/mentor
2. Update dokumentasi sesuai kebutuhan
3. Tambahkan fitur baru
4. Setup CI/CD pipeline (optional)

---

**© 2024 Money Mentor Pro - Platform Literasi Finansial dan Investasi** 