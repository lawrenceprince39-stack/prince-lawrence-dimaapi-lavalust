CREATE DATABASE IF NOT EXISTS mydb
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE mydb;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO users (firstname, lastname, email, username) VALUES
    ('Prince', 'Dimaapi', 'prince.dimaapi@example.com', 'princedimaapi'),
    ('Maria', 'Santos', 'maria.santos@example.com', 'mariasantos'),
    ('Pedro', 'Garcia', 'pedro.garcia@example.com', 'pedrogarcia'),
    ('Ana', 'Reyes', 'ana.reyes@example.com', 'anareyes'),
    ('Jose', 'Mendoza', 'jose.mendoza@example.com', 'josemendoza')
ON DUPLICATE KEY UPDATE firstname = VALUES(firstname);
