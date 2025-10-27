<?php
namespace App\Database;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db = 'php_app';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    public function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            $pdo = new PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }
}
