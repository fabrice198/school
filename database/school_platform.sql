CREATE DATABASE IF NOT EXISTS school_platform
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE school_platform;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher', 'admin') NOT NULL DEFAULT 'student',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- New public registrations are always assigned the student role.
-- Create or promote trusted teacher/admin accounts manually after verifying the user.