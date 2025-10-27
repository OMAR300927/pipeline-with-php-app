CREATE DATABASE IF NOT EXISTS php_app;
USE php_app;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

INSERT INTO users (name, email) VALUES
('Omar Hussein', 'omar@example.com'),
('Ali Ahmed', 'ali@example.com');
