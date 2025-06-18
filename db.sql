-- Database: Travel
CREATE DATABASE IF NOT EXISTS Travel ;
USE Travel;

-- Table to store user information
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Store hashed passwords for security
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table to store travel itineraries
CREATE TABLE IF NOT EXISTS itineraries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    destination VARCHAR(255) NOT NULL,
    travel_date DATE,
    activities TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);