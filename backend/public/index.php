<?php
require_once __DIR__ . '/../vendor/autoload.php'; // استدعاء المكتبات عبر Composer
require_once __DIR__ . '/../src/database/Database.php';
require_once __DIR__ . '/../src/controllers/UserController.php';

use App\Controllers\UserController;
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

// تهيئة Registry للمقاييس
$registry = new CollectorRegistry(new InMemory());

// إنشاء عداد لعدد الطلبات لكل endpoint
$requestCounter = $registry->getOrRegisterCounter(
    'myapp', // namespace
    'http_requests_total', // metric name
    'Total HTTP requests', // description
    ['endpoint'] // label
);

$uri = $_SERVER['REQUEST_URI'];

// إذا كانت الطلبات على endpoint /metrics → عرض Metrics
if ($uri === '/metrics') {
    $renderer = new RenderTextFormat();
    header('Content-Type: ' . RenderTextFormat::MIME_TYPE);
    echo $renderer->render($registry->getMetricFamilySamples());
    exit;
}

// زيادة العداد لكل طلب
$requestCounter->inc([$uri]);

// باقي منطق التطبيق
if ($uri === '/api/users') {
    $controller = new UserController();
    echo json_encode($controller->getAllUsers());
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Not Found']);
}
