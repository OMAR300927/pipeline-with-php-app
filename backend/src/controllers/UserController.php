<?php
namespace App\Controllers;

use App\Database\Database;
use App\Models\User;
use PDO;

class UserController {
    public function getAllUsers() {
        $db = new Database();
        $pdo = $db->connect();

        $stmt = $pdo->query('SELECT id, name, email FROM users');
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row['id'], $row['name'], $row['email']);
        }
        return $users;
    }
}
