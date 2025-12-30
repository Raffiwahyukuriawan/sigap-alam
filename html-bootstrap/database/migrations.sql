-- ============================
-- SIGAP ALAM Database Schema
-- ============================

-- 1. Tabel users
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'contributor', 'admin') DEFAULT 'user',
    photo VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_role (role),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabel disaster_categories
CREATE TABLE disaster_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    icon VARCHAR(255) NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabel articles
CREATE TABLE articles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    disaster_category_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    cover_image VARCHAR(255) NULL,
    status ENUM('draft', 'pending', 'published', 'rejected') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (disaster_category_id) REFERENCES disaster_categories(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_disaster_category_id (disaster_category_id),
    INDEX idx_status (status),
    INDEX idx_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabel article_comments
CREATE TABLE article_comments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    article_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    INDEX idx_article_id (article_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Tabel prevention_tips
CREATE TABLE prevention_tips (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    disaster_category_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (disaster_category_id) REFERENCES disaster_categories(id) ON DELETE CASCADE,
    INDEX idx_disaster_category_id (disaster_category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Tabel article_approvals
CREATE TABLE article_approvals (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    article_id BIGINT UNSIGNED NOT NULL,
    admin_id BIGINT UNSIGNED NOT NULL,
    status ENUM('approved', 'rejected') NOT NULL,
    note TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_article_id (article_id),
    INDEX idx_admin_id (admin_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================
-- Sample Data / Seeders
-- ============================

-- Insert sample users
INSERT INTO users (name, email, password, role) VALUES
('Admin User', 'admin@sigapalam.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Contributor User', 'contributor@sigapalam.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'contributor'),
('Regular User', 'user@sigapalam.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Insert sample disaster categories
INSERT INTO disaster_categories (name, icon, description) VALUES
('Banjir', 'droplets', 'Banjir adalah peristiwa tergenangnya daratan oleh air dalam jumlah besar. Pelajari cara pencegahan dan mitigasi banjir.'),
('Gempa Bumi', 'alert-triangle', 'Gempa bumi adalah getaran atau guncangan yang terjadi di permukaan bumi akibat pelepasan energi dari dalam secara tiba-tiba.'),
('Tsunami', 'waves', 'Tsunami adalah gelombang laut yang sangat besar yang disebabkan oleh gangguan di dasar laut seperti gempa atau letusan gunung api.'),
('Kebakaran Hutan', 'flame', 'Kebakaran hutan dan lahan adalah bencana yang merusak ekosistem dan menghasilkan polusi udara berbahaya.'),
('Tanah Longsor', 'mountain', 'Tanah longsor adalah perpindahan material pembentuk lereng berupa batuan, bahan rombakan, tanah, atau material campuran.'),
('Badai', 'wind', 'Badai adalah gangguan atmosfer yang ditandai dengan angin kencang, hujan deras, petir, dan kondisi cuaca ekstrem lainnya.'),
('Kekeringan', 'cloud-rain', 'Kekeringan adalah kondisi kekurangan pasokan air dalam waktu yang cukup lama akibat curah hujan di bawah normal.'),
('Gunung Meletus', 'zap', 'Letusan gunung berapi adalah peristiwa keluarnya magma, abu vulkanik, dan gas dari dalam bumi melalui gunung berapi.');

-- Insert sample articles
INSERT INTO articles (user_id, disaster_category_id, title, slug, content, cover_image, status, published_at) VALUES
(2, 1, 'Cara Menghadapi Banjir di Musim Hujan', 'cara-menghadapi-banjir-di-musim-hujan', 'Langkah-langkah penting untuk melindungi keluarga dan properti dari ancaman banjir...', 'banjir-1.jpg', 'published', NOW()),
(2, 2, 'Mitigasi Bencana Gempa Bumi untuk Keluarga', 'mitigasi-bencana-gempa-bumi-untuk-keluarga', 'Persiapan dan tindakan yang harus dilakukan sebelum, saat, dan setelah gempa bumi...', 'gempa-1.jpg', 'published', NOW()),
(2, 5, 'Pentingnya Reboisasi untuk Cegah Longsor', 'pentingnya-reboisasi-untuk-cegah-longsor', 'Peran vegetasi dan penghijauan dalam mencegah bencana tanah longsor di area rawan...', 'longsor-1.jpg', 'published', NOW());

-- Insert sample prevention tips
INSERT INTO prevention_tips (disaster_category_id, title, content) VALUES
(1, 'Persiapan Sebelum Banjir', '1. Siapkan tas siaga bencana\n2. Pastikan saluran air tidak tersumbat\n3. Simpan dokumen penting di tempat aman'),
(2, 'Saat Terjadi Gempa', '1. Drop - Cover - Hold On\n2. Jauhi benda yang bisa jatuh\n3. Keluar dari bangunan jika memungkinkan'),
(4, 'Mencegah Kebakaran Hutan', '1. Jangan membuang puntung rokok sembarangan\n2. Tidak membakar sampah di area hutan\n3. Laporkan asap yang mencurigakan');
