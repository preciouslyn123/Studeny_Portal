CREATE DATABASE IF NOT EXISTS student_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_portal;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL,
  student_number VARCHAR(30) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','student') NOT NULL DEFAULT 'student',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_users_email (email),
  UNIQUE KEY uq_users_student_number (student_number),
  KEY idx_users_role_created (role, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Demo admin account for local grading. Change this password immediately on a public deployment.
-- Email: admin@campusconnect.test | Password: CampusAdmin2026!
INSERT INTO users (full_name,email,student_number,password_hash,role)
VALUES ('CampusConnect Administrator','admin@campusconnect.test','ADMIN-001','$2y$12$ERDQPNoJCZjCJtmadsjWT.jMv/WI4pho9/7Lrw2y2XIgvEfNMaDWW','admin')
ON DUPLICATE KEY UPDATE email=email;
