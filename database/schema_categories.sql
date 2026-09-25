-- Migration Step: categories master table
-- Migration Order: 2. categories (after admin_users in final architecture, built first as requested)

CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `type` ENUM('product', 'gallery', 'brand') NOT NULL,
    `image` VARCHAR(255) NOT NULL DEFAULT '',
    `icon` VARCHAR(100) NOT NULL DEFAULT '',
    `short_description` VARCHAR(255) NOT NULL DEFAULT '',
    `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    `sort_order` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `uq_categories_name_type` (`name`, `type`),
    INDEX `idx_categories_type` (`type`),
    INDEX `idx_categories_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Step 5: Seed Data
-- Insert 2 example rows: one type="product", one type="gallery"
INSERT INTO `categories` (`name`, `type`, `image`, `icon`, `short_description`, `status`, `sort_order`) 
VALUES 
('Gas Stove', 'product', '', 'fa-fire-burner', 'Premium quality high-efficiency gas stoves for modern kitchens.', 'active', 1),
('Events', 'gallery', '', 'fa-camera-retro', 'Corporate events, exhibitions, and brand product showcases.', 'active', 2)
ON DUPLICATE KEY UPDATE `short_description` = VALUES(`short_description`);
