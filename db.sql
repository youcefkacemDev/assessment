-- Create database
CREATE DATABASE IF NOT EXISTS assessment;

-- Use the database
USE assessment;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert 20 user records
INSERT INTO users (name, email, password) VALUES
('John Smith', 'john.smith@example.com', '$2y$10$abcdefghijklmnopqrstuvwxyz123456'),
('Emma Johnson', 'emma.johnson@example.com', '$2y$10$bcdefghijklmnopqrstuvwxyz1234567'),
('Michael Brown', 'michael.brown@example.com', '$2y$10$cdefghijklmnopqrstuvwxyz12345678'),
('Sarah Davis', 'sarah.davis@example.com', '$2y$10$defghijklmnopqrstuvwxyz123456789'),
('James Wilson', 'james.wilson@example.com', '$2y$10$efghijklmnopqrstuvwxyz1234567890'),
('Lisa Anderson', 'lisa.anderson@example.com', '$2y$10$fghijklmnopqrstuvwxyz12345678901'),
('David Martinez', 'david.martinez@example.com', '$2y$10$ghijklmnopqrstuvwxyz123456789012'),
('Jennifer Garcia', 'jennifer.garcia@example.com', '$2y$10$hijklmnopqrstuvwxyz1234567890123'),
('Robert Rodriguez', 'robert.rodriguez@example.com', '$2y$10$ijklmnopqrstuvwxyz12345678901234'),
('Mary Hernandez', 'mary.hernandez@example.com', '$2y$10$jklmnopqrstuvwxyz123456789012345'),
('William Lopez', 'william.lopez@example.com', '$2y$10$klmnopqrstuvwxyz1234567890123456'),
('Patricia Gonzalez', 'patricia.gonzalez@example.com', '$2y$10$lmnopqrstuvwxyz12345678901234567'),
('Christopher Perez', 'christopher.perez@example.com', '$2y$10$mnopqrstuvwxyz123456789012345678'),
('Linda Taylor', 'linda.taylor@example.com', '$2y$10$nopqrstuvwxyz1234567890123456789'),
('Daniel Moore', 'daniel.moore@example.com', '$2y$10$opqrstuvwxyz12345678901234567890'),
('Barbara Jackson', 'barbara.jackson@example.com', '$2y$10$pqrstuvwxyz123456789012345678901'),
('Matthew Martin', 'matthew.martin@example.com', '$2y$10$qrstuvwxyz1234567890123456789012'),
('Susan Lee', 'susan.lee@example.com', '$2y$10$rstuvwxyz12345678901234567890123'),
('Joseph White', 'joseph.white@example.com', '$2y$10$stuvwxyz123456789012345678901234'),
('Nancy Harris', 'nancy.harris@example.com', '$2y$10$tuvwxyz1234567890123456789012345');