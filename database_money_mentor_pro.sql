-- =====================================================
-- DATABASE MONEY MENTOR PRO
-- Platform Literasi Finansial dan Investasi Berbasis Web
-- Berdasarkan Jurnal: Rancang Bangun Literasi Finansial dan Investasi Money Mentor Pro
-- =====================================================

-- Buat database
CREATE DATABASE IF NOT EXISTS money_mentor_pro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE money_mentor_pro;

-- =====================================================
-- TABEL USERS (Pengguna)
-- =====================================================
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20),
    birth_date DATE,
    profile_picture VARCHAR(255) DEFAULT 'default.jpg',
    investment_experience ENUM('beginner', 'intermediate', 'advanced') DEFAULT 'beginner',
    is_active TINYINT(1) DEFAULT 1,
    is_verified TINYINT(1) DEFAULT 0,
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABEL CATEGORIES (Kategori Artikel)
-- =====================================================
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    icon VARCHAR(50),
    color VARCHAR(7) DEFAULT '#3498db',
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABEL ARTICLES (Artikel Literasi)
-- =====================================================
CREATE TABLE articles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT NOT NULL,
    excerpt TEXT,
    featured_image VARCHAR(255),
    author_id INT,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    view_count INT DEFAULT 0,
    reading_time INT DEFAULT 5, -- dalam menit
    is_featured TINYINT(1) DEFAULT 0,
    meta_title VARCHAR(255),
    meta_description TEXT,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
);

-- =====================================================
-- TABEL VIDEOS (Video Tutorial)
-- =====================================================
CREATE TABLE videos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    video_url VARCHAR(255) NOT NULL,
    thumbnail VARCHAR(255),
    duration INT, -- dalam detik
    author_id INT,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    view_count INT DEFAULT 0,
    is_featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
);

-- =====================================================
-- TABEL INVESTMENT_PRODUCTS (Produk Investasi)
-- =====================================================
CREATE TABLE investment_products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    type ENUM('saham', 'reksadana', 'obligasi', 'emas', 'crypto', 'property') NOT NULL,
    description TEXT,
    risk_level ENUM('low', 'medium', 'high') NOT NULL,
    min_investment DECIMAL(15,2),
    expected_return DECIMAL(5,2), -- dalam persen
    image VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABEL SIMULATIONS (Simulasi Investasi)
-- =====================================================
CREATE TABLE simulations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    product_id INT,
    initial_amount DECIMAL(15,2) NOT NULL,
    monthly_contribution DECIMAL(15,2) DEFAULT 0,
    duration_months INT NOT NULL,
    expected_return_rate DECIMAL(5,2),
    final_amount DECIMAL(15,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES investment_products(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL USER_PREFERENCES (Preferensi Pengguna)
-- =====================================================
CREATE TABLE user_preferences (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE,
    preferred_categories TEXT, -- JSON array of category IDs
    investment_goals TEXT, -- JSON array of goals
    risk_tolerance ENUM('low', 'medium', 'high') DEFAULT 'medium',
    notification_email TINYINT(1) DEFAULT 1,
    notification_push TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL BOOKMARKS (Bookmark Artikel/Video)
-- =====================================================
CREATE TABLE bookmarks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    content_type ENUM('article', 'video') NOT NULL,
    content_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_bookmark (user_id, content_type, content_id)
);

-- =====================================================
-- TABEL READING_HISTORY (Riwayat Membaca)
-- =====================================================
CREATE TABLE reading_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    content_type ENUM('article', 'video') NOT NULL,
    content_id INT NOT NULL,
    progress DECIMAL(5,2) DEFAULT 0, -- persentase progress
    last_read_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL WEBINARS (Webinar)
-- =====================================================
CREATE TABLE webinars (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    speaker_name VARCHAR(100),
    speaker_bio TEXT,
    webinar_date DATETIME NOT NULL,
    duration INT, -- dalam menit
    max_participants INT,
    current_participants INT DEFAULT 0,
    meeting_link VARCHAR(255),
    recording_url VARCHAR(255),
    status ENUM('upcoming', 'live', 'completed', 'cancelled') DEFAULT 'upcoming',
    is_free TINYINT(1) DEFAULT 1,
    price DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABEL WEBINAR_REGISTRATIONS (Pendaftaran Webinar)
-- =====================================================
CREATE TABLE webinar_registrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    webinar_id INT,
    user_id INT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    attended TINYINT(1) DEFAULT 0,
    attended_at TIMESTAMP NULL,
    FOREIGN KEY (webinar_id) REFERENCES webinars(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_registration (webinar_id, user_id)
);

-- =====================================================
-- TABEL CHALLENGES (Challenge Bulanan)
-- =====================================================
CREATE TABLE challenges (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    challenge_type ENUM('investment', 'quiz', 'learning') NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    reward_description TEXT,
    max_participants INT,
    current_participants INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- TABEL CHALLENGE_PARTICIPANTS (Peserta Challenge)
-- =====================================================
CREATE TABLE challenge_participants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    challenge_id INT,
    user_id INT,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    score DECIMAL(5,2) DEFAULT 0,
    rank INT,
    FOREIGN KEY (challenge_id) REFERENCES challenges(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_participation (challenge_id, user_id)
);

-- =====================================================
-- TABEL QUIZZES (Kuis Pengetahuan)
-- =====================================================
CREATE TABLE quizzes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category_id INT,
    difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
    time_limit INT, -- dalam menit, NULL = unlimited
    passing_score DECIMAL(5,2) DEFAULT 70,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- =====================================================
-- TABEL QUIZ_QUESTIONS (Pertanyaan Kuis)
-- =====================================================
CREATE TABLE quiz_questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quiz_id INT,
    question TEXT NOT NULL,
    question_type ENUM('multiple_choice', 'true_false', 'essay') DEFAULT 'multiple_choice',
    points INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL QUIZ_OPTIONS (Opsi Jawaban)
-- =====================================================
CREATE TABLE quiz_options (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT,
    option_text TEXT NOT NULL,
    is_correct TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (question_id) REFERENCES quiz_questions(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL QUIZ_ATTEMPTS (Percobaan Kuis)
-- =====================================================
CREATE TABLE quiz_attempts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quiz_id INT,
    user_id INT,
    started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    score DECIMAL(5,2) DEFAULT 0,
    max_score INT DEFAULT 0,
    passed TINYINT(1) DEFAULT 0,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL NOTIFICATIONS (Notifikasi)
-- =====================================================
CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('info', 'success', 'warning', 'error') DEFAULT 'info',
    is_read TINYINT(1) DEFAULT 0,
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =====================================================
-- TABEL SETTINGS (Pengaturan Sistem)
-- =====================================================
CREATE TABLE settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type ENUM('string', 'integer', 'boolean', 'json') DEFAULT 'string',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- INSERT DATA AWAL
-- =====================================================

-- Insert default categories
INSERT INTO categories (name, slug, description, icon, color) VALUES
('Investasi Saham', 'investasi-saham', 'Artikel dan tutorial tentang investasi saham', 'fas fa-chart-line', '#e74c3c'),
('Reksa Dana', 'reksadana', 'Panduan lengkap tentang reksa dana', 'fas fa-chart-pie', '#3498db'),
('Obligasi', 'obligasi', 'Informasi tentang investasi obligasi', 'fas fa-file-invoice-dollar', '#f39c12'),
('Emas', 'emas', 'Tips dan strategi investasi emas', 'fas fa-coins', '#f1c40f'),
('Cryptocurrency', 'cryptocurrency', 'Panduan investasi cryptocurrency', 'fas fa-bitcoin', '#9b59b6'),
('Properti', 'properti', 'Investasi properti dan real estate', 'fas fa-home', '#1abc9c'),
('Literasi Finansial', 'literasi-finansial', 'Dasar-dasar keuangan pribadi', 'fas fa-graduation-cap', '#2c3e50'),
('Perencanaan Keuangan', 'perencanaan-keuangan', 'Tips perencanaan keuangan masa depan', 'fas fa-piggy-bank', '#27ae60');

-- Insert default investment products
INSERT INTO investment_products (name, type, description, risk_level, min_investment, expected_return) VALUES
('Saham Blue Chip', 'saham', 'Saham perusahaan besar yang stabil', 'low', 100000, 8.50),
('Reksa Dana Pasar Uang', 'reksadana', 'Reksa dana dengan risiko rendah', 'low', 10000, 5.00),
('Reksa Dana Campuran', 'reksadana', 'Kombinasi saham dan obligasi', 'medium', 50000, 12.00),
('Obligasi Pemerintah', 'obligasi', 'Obligasi dengan jaminan pemerintah', 'low', 1000000, 6.50),
('Emas Antam', 'emas', 'Investasi emas fisik', 'low', 500000, 7.00),
('Bitcoin', 'crypto', 'Cryptocurrency terpopuler', 'high', 100000, 25.00);

-- Insert default settings
INSERT INTO settings (setting_key, setting_value, setting_type, description) VALUES
('site_name', 'Money Mentor Pro', 'string', 'Nama website'),
('site_description', 'Platform Literasi Finansial dan Investasi Terdepan', 'string', 'Deskripsi website'),
('maintenance_mode', '0', 'boolean', 'Mode maintenance website'),
('registration_enabled', '1', 'boolean', 'Apakah registrasi dibuka'),
('max_file_size', '5242880', 'integer', 'Ukuran maksimal upload file (bytes)'),
('default_currency', 'IDR', 'string', 'Mata uang default'),
('contact_email', 'admin@moneymentorpro.com', 'string', 'Email kontak admin');

-- Insert admin user (password: admin123)
INSERT INTO users (username, email, password, first_name, last_name, phone, birth_date, investment_experience, is_active, is_verified) VALUES
('admin', 'admin@moneymentorpro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'System', '081234567890', '1990-01-01', 'advanced', 1, 1);

-- =====================================================
-- INDEXES UNTUK OPTIMASI PERFORMANCE
-- =====================================================

-- Index untuk pencarian artikel
CREATE INDEX idx_articles_title ON articles(title);
CREATE INDEX idx_articles_status ON articles(status);
CREATE INDEX idx_articles_published_at ON articles(published_at);

-- Index untuk user activity
CREATE INDEX idx_reading_history_user ON reading_history(user_id);
CREATE INDEX idx_bookmarks_user ON bookmarks(user_id);

-- Index untuk simulasi
CREATE INDEX idx_simulations_user ON simulations(user_id);

-- Index untuk notifikasi
CREATE INDEX idx_notifications_user_read ON notifications(user_id, is_read);

-- =====================================================
-- VIEWS UNTUK REPORTING
-- =====================================================

-- View untuk statistik artikel
CREATE VIEW article_stats AS
SELECT 
    c.name as category_name,
    COUNT(a.id) as total_articles,
    SUM(a.view_count) as total_views,
    AVG(a.view_count) as avg_views
FROM categories c
LEFT JOIN articles a ON c.id = a.category_id AND a.status = 'published'
GROUP BY c.id, c.name;

-- View untuk user activity
CREATE VIEW user_activity AS
SELECT 
    u.id,
    u.username,
    u.email,
    COUNT(DISTINCT rh.content_id) as articles_read,
    COUNT(DISTINCT b.content_id) as bookmarks_count,
    COUNT(DISTINCT s.id) as simulations_count,
    u.created_at as joined_date
FROM users u
LEFT JOIN reading_history rh ON u.id = rh.user_id
LEFT JOIN bookmarks b ON u.id = b.user_id
LEFT JOIN simulations s ON u.id = s.user_id
GROUP BY u.id, u.username, u.email, u.created_at;

-- =====================================================
-- TRIGGERS UNTUK MAINTENANCE DATA
-- =====================================================

-- Trigger untuk update view count
DELIMITER //
CREATE TRIGGER update_article_view_count
AFTER INSERT ON reading_history
FOR EACH ROW
BEGIN
    IF NEW.content_type = 'article' THEN
        UPDATE articles SET view_count = view_count + 1 WHERE id = NEW.content_id;
    END IF;
END//
DELIMITER ;

-- Trigger untuk update participant count
DELIMITER //
CREATE TRIGGER update_webinar_participants
AFTER INSERT ON webinar_registrations
FOR EACH ROW
BEGIN
    UPDATE webinars SET current_participants = current_participants + 1 WHERE id = NEW.webinar_id;
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER update_webinar_participants_delete
AFTER DELETE ON webinar_registrations
FOR EACH ROW
BEGIN
    UPDATE webinars SET current_participants = current_participants - 1 WHERE id = OLD.webinar_id;
END//
DELIMITER ;

-- =====================================================
-- STORED PROCEDURES
-- =====================================================

-- Procedure untuk mendapatkan artikel populer
DELIMITER //
CREATE PROCEDURE GetPopularArticles(IN limit_count INT)
BEGIN
    SELECT 
        a.id,
        a.title,
        a.slug,
        a.excerpt,
        a.featured_image,
        a.view_count,
        a.reading_time,
        c.name as category_name,
        CONCAT(u.first_name, ' ', u.last_name) as author_name
    FROM articles a
    LEFT JOIN categories c ON a.category_id = c.id
    LEFT JOIN users u ON a.author_id = u.id
    WHERE a.status = 'published'
    ORDER BY a.view_count DESC
    LIMIT limit_count;
END//
DELIMITER ;

-- Procedure untuk mendapatkan rekomendasi artikel berdasarkan preferensi user
DELIMITER //
CREATE PROCEDURE GetRecommendedArticles(IN user_id INT, IN limit_count INT)
BEGIN
    SELECT 
        a.id,
        a.title,
        a.slug,
        a.excerpt,
        a.featured_image,
        a.view_count,
        c.name as category_name
    FROM articles a
    LEFT JOIN categories c ON a.category_id = c.id
    WHERE a.status = 'published'
    AND a.category_id IN (
        SELECT JSON_EXTRACT(preferred_categories, '$[*]') 
        FROM user_preferences 
        WHERE user_id = user_id
    )
    ORDER BY a.view_count DESC
    LIMIT limit_count;
END//
DELIMITER ;

-- =====================================================
-- SAMPLE DATA UNTUK TESTING
-- =====================================================

-- Insert sample articles
INSERT INTO articles (category_id, title, slug, content, excerpt, author_id, status, view_count, reading_time, is_featured) VALUES
(1, 'Panduan Lengkap Investasi Saham untuk Pemula', 'panduan-lengkap-investasi-saham-pemula', 
'<h2>Apa itu Saham?</h2><p>Saham adalah bukti kepemilikan atas suatu perusahaan...</p><h2>Keuntungan Investasi Saham</h2><p>Investasi saham memberikan beberapa keuntungan...</p>', 
'Panduan lengkap untuk memulai investasi saham dari nol hingga mahir.', 1, 'published', 1250, 8, 1),

(2, 'Memilih Reksa Dana yang Tepat', 'memilih-reksadana-yang-tepat',
'<h2>Jenis-jenis Reksa Dana</h2><p>Ada beberapa jenis reksa dana yang bisa dipilih...</p><h2>Tips Memilih Reksa Dana</h2><p>Berikut adalah tips untuk memilih reksa dana...</p>',
'Tips dan trik memilih reksa dana yang sesuai dengan profil risiko Anda.', 1, 'published', 890, 6, 1),

(7, 'Mengatur Keuangan Pribadi dengan 50/30/20', 'mengatur-keuangan-pribadi-50-30-20',
'<h2>Prinsip 50/30/20</h2><p>Prinsip ini membagi penghasilan menjadi tiga bagian...</p><h2>Cara Menerapkan</h2><p>Berikut cara menerapkan prinsip 50/30/20...</p>',
'Panduan mengatur keuangan pribadi menggunakan prinsip 50/30/20.', 1, 'published', 2100, 10, 1);

-- Insert sample videos
INSERT INTO videos (category_id, title, description, video_url, thumbnail, duration, author_id, status, view_count) VALUES
(1, 'Tutorial Analisis Teknikal Saham', 'Video tutorial lengkap tentang analisis teknikal untuk investasi saham', 
'https://www.youtube.com/watch?v=sample1', 'thumbnail1.jpg', 1800, 1, 'published', 560),

(2, 'Cara Membaca Prospektus Reksa Dana', 'Panduan membaca dan memahami prospektus reksa dana', 
'https://www.youtube.com/watch?v=sample2', 'thumbnail2.jpg', 1200, 1, 'published', 320);

-- Insert sample webinars
INSERT INTO webinars (title, description, speaker_name, speaker_bio, webinar_date, duration, max_participants, meeting_link, status, is_free) VALUES
('Investasi Saham di Era Digital', 'Webinar tentang strategi investasi saham di era digital', 
'Dr. Ahmad Fauzi', 'Analis saham senior dengan pengalaman 15 tahun', 
'2024-02-15 19:00:00', 90, 100, 'https://meet.google.com/sample', 'upcoming', 1),

('Perencanaan Keuangan untuk Milenial', 'Tips perencanaan keuangan khusus untuk generasi milenial', 
'Sarah Wijaya', 'Financial planner dan influencer keuangan', 
'2024-02-20 20:00:00', 60, 150, 'https://meet.google.com/sample2', 'upcoming', 1);

-- Insert sample challenges
INSERT INTO challenges (title, description, challenge_type, start_date, end_date, reward_description, max_participants) VALUES
('Challenge Investasi Virtual Februari 2024', 'Kompetisi portofolio investasi virtual dengan hadiah menarik', 
'investment', '2024-02-01', '2024-02-29', 'Hadiah uang tunai Rp 5.000.000 untuk pemenang', 500),

('Kuis Literasi Finansial', 'Uji pengetahuan Anda tentang literasi finansial', 
'quiz', '2024-02-10', '2024-02-15', 'E-book gratis dan sertifikat', 1000);

COMMIT; 