-- Migration Step: users master table
-- Migration Order: 1. admin_users (renamed to users as requested)

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) DEFAULT '',
    `address` TEXT DEFAULT NULL,
    `profile_image` VARCHAR(255) DEFAULT '',
    `role` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1 = Admin, 0 = User',
    `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1 = Active, 0 = Inactive',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_users_role` (`role`),
    INDEX `idx_users_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Step: Seed exactly ONE row for the admin login
INSERT INTO `users` (`name`, `email`, `password`, `phone`, `address`, `profile_image`, `role`, `status`)
VALUES 
('Super Admin', 'admin@gmail.com', '$2y$12$644vcZx54NygzH6NmsF18.7tICVj5OpuZgzk4T9quWmFnqKS4Stam', '+91 9876543210', 'Nandani Corporate Office, Gujarat, India', '', 1, 1)
ON DUPLICATE KEY UPDATE 
    `name` = VALUES(`name`),
    `password` = VALUES(`password`),
    `role` = VALUES(`role`),
    `status` = VALUES(`status`);
