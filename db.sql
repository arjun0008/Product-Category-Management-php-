-- ============================================
-- Product & Category Management System
-- Database Dump
-- ============================================

CREATE DATABASE IF NOT EXISTS pcm
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE pcm;

-- USERS TABLE
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CATEGORIES TABLE
DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    status TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- PRODUCTS TABLE
DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category_id INT NOT NULL,
    status TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_products_category
        FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON DELETE RESTRICT
);

-- ============================================
-- ADMIN USER
-- username: admin
-- password: admin
-- ============================================

INSERT INTO users (username, password)
VALUES (
    'admin',
    '$2y$10$8dKQy4pXK1wzP9z5q9KX5e9cM2vU9n8kZC5JZQ8PpZ6ZzU0k0KQbG'
);
