-- Base de données FAITH DECOR (MySQL 8+ / MariaDB 10.4+)
-- Importez ce fichier avec phpMyAdmin ou : mysql -u root -p < db/schema.sql

CREATE DATABASE IF NOT EXISTS faith_decor
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE faith_decor;

CREATE TABLE IF NOT EXISTS admins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor') NOT NULL DEFAULT 'admin',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_admins_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(50) NOT NULL,
    category_label VARCHAR(100) NOT NULL,
    rental_price DECIMAL(10,2) NOT NULL,
    promo_percentage DECIMAL(5,2) DEFAULT NULL,
    image_url VARCHAR(500) NOT NULL,
    description TEXT DEFAULT NULL,
    details TEXT DEFAULT NULL,
    is_popular TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_categories_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO categories (slug, name, sort_order)
SELECT 'tenues', 'Tenues & Robes', 1 WHERE NOT EXISTS (SELECT 1 FROM categories WHERE slug = 'tenues');
INSERT INTO categories (slug, name, sort_order)
SELECT 'bijoux', 'Bijoux & Parures', 2 WHERE NOT EXISTS (SELECT 1 FROM categories WHERE slug = 'bijoux');
INSERT INTO categories (slug, name, sort_order)
SELECT 'accessoires', 'Accessoires & Couronnes', 3 WHERE NOT EXISTS (SELECT 1 FROM categories WHERE slug = 'accessoires');
INSERT INTO categories (slug, name, sort_order)
SELECT 'hommes', 'Tenues Hommes', 4 WHERE NOT EXISTS (SELECT 1 FROM categories WHERE slug = 'hommes');

-- Mise à niveau si vous aviez déjà importé une ancienne version du schéma :
-- ALTER TABLE products ADD COLUMN promo_percentage DECIMAL(5,2) DEFAULT NULL AFTER rental_price;
-- ALTER TABLE products DROP COLUMN original_price, DROP COLUMN promo_price;

-- Éléments du simulateur, modifiables depuis l'administration.
CREATE TABLE IF NOT EXISTS estimation_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_type ENUM('event', 'location', 'option') NOT NULL,
    label VARCHAR(100) NOT NULL,
    price DECIMAL(12,2) NOT NULL DEFAULT 0,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY idx_estimation_items_type_active (item_type, is_active, sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS estimation_settings (
    setting_key VARCHAR(50) PRIMARY KEY,
    setting_value DECIMAL(12,2) NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'event', 'Mariage', 500000, 1 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'event');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'event', 'Baptême', 300000, 2 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'event' AND label = 'Baptême');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'event', 'Fête', 250000, 3 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'event' AND label = 'Fête');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'location', 'En plein air', 150000, 1 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'location');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'location', 'Salle', 100000, 2 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'location' AND label = 'Salle');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'location', 'À domicile', 50000, 3 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'location' AND label = 'À domicile');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'option', 'Arche Premium', 250000, 1 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'option');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'option', 'Fleurs supplémentaires', 150000, 2 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'option' AND label = 'Fleurs supplémentaires');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'option', 'Lumières d’ambiance', 200000, 3 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'option' AND label = 'Lumières d’ambiance');
INSERT INTO estimation_items (item_type, label, price, sort_order)
SELECT 'option', 'Photobooth', 175000, 4 WHERE NOT EXISTS (SELECT 1 FROM estimation_items WHERE item_type = 'option' AND label = 'Photobooth');
INSERT INTO estimation_settings (setting_key, setting_value) VALUES ('guest_price', 2500)
ON DUPLICATE KEY UPDATE setting_key = setting_key;

-- Créez ensuite un mot de passe sécurisé depuis le terminal :
-- php -r "echo password_hash('VotreMotDePasseFort', PASSWORD_DEFAULT), PHP_EOL;"
-- Puis ajoutez l'administrateur (remplacez VALEUR_DU_HASH) :
-- INSERT INTO admins (full_name, email, password_hash)
-- VALUES ('Administrateur', 'admin@faithdecor.com', 'VALEUR_DU_HASH');
