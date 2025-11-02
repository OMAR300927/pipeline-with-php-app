<?php
require __DIR__ . '/../vendor/autoload.php';

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

$registry = new CollectorRegistry(new InMemory());
$counter = $registry->getOrRegisterCounter('app', 'requests_total', 'عدد الطلبات', ['method', 'endpoint']);
$counter->inc(['GET', '/metrics']);

$renderer = new RenderTextFormat();
$result = $renderer->render($registry->getMetricFamilySamples());
header('Content-type: ' . RenderTextFormat::MIME_TYPE);
echo $result;
