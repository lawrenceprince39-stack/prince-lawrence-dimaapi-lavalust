<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class LabDatabaseSetup
{
    private static $ready = false;

    public static function ensure($db)
    {
        if (self::$ready) {
            return;
        }

        $db->raw(
            'CREATE DATABASE IF NOT EXISTS mydb '
            . 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
        );
        $db->raw('USE mydb');

        $db->raw(
            'CREATE TABLE IF NOT EXISTS users ('
            . 'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,'
            . 'firstname VARCHAR(100) NOT NULL,'
            . 'lastname VARCHAR(100) NOT NULL,'
            . 'email VARCHAR(150) NOT NULL UNIQUE,'
            . 'username VARCHAR(100) NOT NULL UNIQUE'
            . ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        $db->raw(
            "INSERT IGNORE INTO users (firstname, lastname, email, username) VALUES "
            . "('Prince', 'Dimaapi', 'prince.dimaapi@example.com', 'princedimaapi'),"
            . "('Maria', 'Santos', 'maria.santos@example.com', 'mariasantos'),"
            . "('Pedro', 'Garcia', 'pedro.garcia@example.com', 'pedrogarcia'),"
            . "('Ana', 'Reyes', 'ana.reyes@example.com', 'anareyes'),"
            . "('Jose', 'Mendoza', 'jose.mendoza@example.com', 'josemendoza')"
        );

        $db->raw(
            'CREATE TABLE IF NOT EXISTS products ('
            . 'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,'
            . 'product_name VARCHAR(100) NOT NULL,'
            . 'description TEXT NOT NULL,'
            . 'price DECIMAL(10,2) NOT NULL DEFAULT 0.00,'
            . 'quantity INT NOT NULL DEFAULT 0,'
            . 'created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,'
            . 'CONSTRAINT chk_products_price CHECK (price >= 0),'
            . 'CONSTRAINT chk_products_quantity CHECK (quantity >= 0)'
            . ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        self::$ready = true;
    }
}
