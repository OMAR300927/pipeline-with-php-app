<?php
require_once __DIR__ . '/../src/database/Database.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

use App\Controllers\UserController;

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/api/users') {
    $controller = new UserController();
    echo json_encode($controller->getAllUsers());
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Not Found']);
}
