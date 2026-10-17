-- =========================================================
-- DATABASE WEBSITE PRAMUKA SKAGARA
-- Laragon / MySQL / MariaDB
-- =========================================================

CREATE DATABASE IF NOT EXISTS pramuka_skagara
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE pramuka_skagara;

-- =========================================================
-- 1. USERS / ADMIN
-- =========================================================
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Akun awal:
-- Username: admin
-- Password: admin123
-- Untuk produksi sebaiknya password diganti/di-hash.
INSERT IGNORE INTO users (nama, username, password)
VALUES ('Administrator', 'admin', 'admin123');

-- =========================================================
-- 2. PROFIL
-- =========================================================
CREATE TABLE IF NOT EXISTS profil (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    isi TEXT NOT NULL,
    gambar VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =========================================================
-- 3. PRESTASI
-- =========================================================
CREATE TABLE IF NOT EXISTS prestasi (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_kejuaraan VARCHAR(200) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    tingkat VARCHAR(100) DEFAULT NULL,
    juara VARCHAR(100) DEFAULT NULL,
    tahun YEAR NOT NULL,
    keterangan TEXT DEFAULT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_prestasi_kategori (kategori),
    INDEX idx_prestasi_tahun (tahun)
) ENGINE=InnoDB;

INSERT INTO prestasi
(nama_kejuaraan, kategori, tingkat, juara, tahun, keterangan)
VALUES
('Kompetisi Keterampilan Sangga (KKS) 2026',
 'Kompetisi', 'Kabupaten', 'Juara 1', 2026,
 'Prestasi Kompetisi Keterampilan Sangga.'),
('Lomba Tingkat Penegak 2026',
 'Kompetisi', 'Kabupaten', 'Juara 2', 2026,
 'Prestasi kegiatan kepramukaan tingkat kabupaten.'),
('Garuda Penegak SKAGARA',
 'Garuda', 'Sekolah', 'Garuda Penegak', 2026,
 'Anggota yang berhasil mencapai Pramuka Garuda.');

-- =========================================================
-- 4. BERITA / KEGIATAN
-- =========================================================
CREATE TABLE IF NOT EXISTS berita (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    tanggal DATE NOT NULL,
    gambar VARCHAR(255) DEFAULT NULL,
    ringkasan TEXT DEFAULT NULL,
    isi TEXT DEFAULT NULL,
    slug VARCHAR(255) DEFAULT NULL,
    status ENUM('draft','publish') DEFAULT 'publish',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_berita_kategori (kategori),
    INDEX idx_berita_tanggal (tanggal),
    INDEX idx_berita_status (status)
) ENGINE=InnoDB;

INSERT INTO berita
(judul, kategori, tanggal, ringkasan, status)
VALUES
('Pelantikan Penegak Bantara & Laksana 2026',
 'Pelantikan', '2026-10-18',
 'Ujian penjelajahan dan perkemahan calon Bantara dan Laksana.',
 'publish'),
('Kompetisi Keterampilan Sangga (KKS) 2026',
 'Kompetisi', '2026-09-05',
 'Kegiatan unjuk keterampilan kepramukaan antar Sangga.',
 'publish'),
('Aksi Reboisasi & Clean-Up Pesisir Pantai Jepara',
 'Aksi Peduli', '2026-08-22',
 'Kegiatan bakti lingkungan dan penanaman bibit mangrove.',
 'publish');

-- =========================================================
-- 5. JADWAL
-- =========================================================
CREATE TABLE IF NOT EXISTS jadwal (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    nama_kegiatan VARCHAR(200) NOT NULL,
    peserta VARCHAR(200) DEFAULT NULL,
    lokasi VARCHAR(200) DEFAULT NULL,
    jam_mulai TIME DEFAULT NULL,
    jam_selesai TIME DEFAULT NULL,
    status VARCHAR(50) DEFAULT 'Terjadwal',
    keterangan TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_jadwal_tanggal (tanggal)
) ENGINE=InnoDB;

INSERT INTO jadwal
(tanggal, nama_kegiatan, peserta, lokasi, jam_mulai, jam_selesai, status)
VALUES
('2026-07-15', 'Penerimaan Tamu Ambalan (PTA)',
 'Siswa Baru Kelas X', 'Pangkalan SKAGARA', '08:00:00', '17:00:00', 'Selesai'),
('2026-08-22', 'Bakti Lingkungan',
 'Seluruh Penegak', 'Pesisir Jepara', '07:00:00', '12:00:00', 'Selesai'),
('2026-10-18', 'Pelantikan Bantara & Laksana',
 'Calon Bantara & Laksana', 'Pangkalan SKAGARA', '07:00:00', '17:00:00', 'Terjadwal');

-- Jadwal rutin mingguan
CREATE TABLE IF NOT EXISTS jadwal_rutin (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    hari VARCHAR(20) NOT NULL,
    nama_kegiatan VARCHAR(200) NOT NULL,
    waktu_mulai TIME NOT NULL,
    waktu_selesai TIME NOT NULL,
    lokasi VARCHAR(200) DEFAULT NULL,
    peserta VARCHAR(200) DEFAULT NULL,
    keterangan TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO jadwal_rutin
(hari, nama_kegiatan, waktu_mulai, waktu_selesai, lokasi, peserta)
VALUES
('Jumat', 'Latihan Rutin Mingguan', '15:00:00', '17:00:00',
 'Lapangan SMK Negeri 3 Jepara', 'Seluruh Penegak'),
('Sabtu', 'Gladian Dewan Ambalan (GDA)', '13:30:00', '16:00:00',
 'Sanggar Bakti Pramuka', 'Dewan Ambalan');

-- =========================================================
-- 6. MATERI
-- =========================================================
CREATE TABLE IF NOT EXISTS materi (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    kategori VARCHAR(150) NOT NULL,
    deskripsi TEXT DEFAULT NULL,
    isi LONGTEXT DEFAULT NULL,
    file_pdf VARCHAR(255) DEFAULT NULL,
    thumbnail VARCHAR(255) DEFAULT NULL,
    tanggal DATE DEFAULT (CURRENT_DATE),
    status ENUM('draft','publish') DEFAULT 'publish',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_materi_kategori (kategori),
    INDEX idx_materi_status (status)
) ENGINE=InnoDB;

INSERT INTO materi
(judul, kategori, deskripsi, status)
VALUES
('Sandi Pramuka Dasar', 'SKU & TKU Penegak',
 'Materi dasar mengenai berbagai jenis sandi dalam kepramukaan.',
 'publish'),
('Pioneering Dasar', 'Scout Skill & Pionering',
 'Panduan dasar pioneering dan penggunaan simpul serta ikatan.',
 'publish'),
('Navigasi Darat', 'Navigasi & Survival',
 'Materi dasar navigasi darat dan penggunaan kompas.',
 'publish'),
('Survival Dasar', 'Navigasi & Survival',
 'Pengetahuan dasar bertahan hidup di alam terbuka.',
 'publish');

-- =========================================================
-- 7. DOKUMENTASI / GALERI
-- =========================================================
CREATE TABLE IF NOT EXISTS dokumentasi (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    kategori VARCHAR(150) NOT NULL,
    tanggal DATE NOT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    video_url VARCHAR(500) DEFAULT NULL,
    deskripsi TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_dokumentasi_kategori (kategori),
    INDEX idx_dokumentasi_tanggal (tanggal)
) ENGINE=InnoDB;

INSERT INTO dokumentasi
(judul, kategori, tanggal, foto, deskripsi)
VALUES
('Pelantikan Penegak Bantara',
 'Pelantikan Penegak', '2026-10-18', NULL,
 'Dokumentasi kegiatan pelantikan Penegak Bantara.'),
('Penerimaan Tamu Ambalan',
 'Perkemahan & PTA', '2026-07-15', NULL,
 'Dokumentasi kegiatan Penerimaan Tamu Ambalan.'),
('Kompetisi Keterampilan Sangga',
 'Lomba & Prestasi', '2026-09-05', NULL,
 'Dokumentasi kegiatan kompetisi keterampilan Sangga.'),
('Bakti Pesisir Jepara',
 'Bakti Pesisir', '2026-08-22', NULL,
 'Dokumentasi kegiatan bakti lingkungan pesisir.');

-- =========================================================
-- 8. PENDAFTARAN
-- =========================================================
CREATE TABLE IF NOT EXISTS pendaftaran (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(150) NOT NULL,
    nisn VARCHAR(30) NOT NULL,
    tempat_lahir VARCHAR(100) DEFAULT NULL,
    tanggal_lahir DATE DEFAULT NULL,
    jenis_kelamin ENUM('L','P') DEFAULT NULL,
    whatsapp VARCHAR(30) DEFAULT NULL,
    agama VARCHAR(50) DEFAULT NULL,
    kelas VARCHAR(20) DEFAULT NULL,
    jurusan VARCHAR(150) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    nama_orang_tua VARCHAR(150) DEFAULT NULL,
    no_whatsapp_orang_tua VARCHAR(30) DEFAULT NULL,
    status ENUM('baru','diproses','diterima','ditolak') DEFAULT 'baru',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_pendaftaran_nisn (nisn),
    INDEX idx_pendaftaran_status (status)
) ENGINE=InnoDB;

-- =========================================================
-- 9. KONTAK / PESAN
-- =========================================================
CREATE TABLE IF NOT EXISTS kontak (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    email VARCHAR(150) DEFAULT NULL,
    whatsapp VARCHAR(30) DEFAULT NULL,
    subjek VARCHAR(200) DEFAULT NULL,
    pesan TEXT NOT NULL,
    status ENUM('baru','dibaca','dibalas') DEFAULT 'baru',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_kontak_status (status)
) ENGINE=InnoDB;

-- =========================================================
-- 10. PENGATURAN WEBSITE
-- =========================================================
CREATE TABLE IF NOT EXISTS pengaturan (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_pengaturan VARCHAR(100) NOT NULL UNIQUE,
    nilai TEXT DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT IGNORE INTO pengaturan (nama_pengaturan, nilai) VALUES
('nama_website', 'Pramuka SKAGARA'),
('gudep', '05.127 - 05.128'),
('sekolah', 'SMK Negeri 3 Jepara'),
('alamat', 'SMK Negeri 3 Jepara'),
('whatsapp', ''),
('instagram', ''),
('facebook', '');

-- =========================================================
-- SELESAI
-- =========================================================
