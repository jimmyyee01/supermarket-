<?php
require __DIR__.'/../config/database.php';
session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = '/supermarket-pos/public';
$path = str_replace($base, '', $uri);
$path = trim($path, '/');
$segments = $path === '' ? [] : explode('/', $path);

$controller = $segments[0] ?? 'dashboard';
$action = $segments[1] ?? 'index';
$id = $segments[2] ?? null;

$map = [
    'auth' => 'AuthController',
    'dashboard' => 'DashboardController',
    'supermarkets' => 'SupermarketController',
    'branches' => 'BranchController',
    'users' => 'UserController',
    'products' => 'ProductController',
    'pos' => 'PosController',
    'android' => 'AndroidController',
    'reports' => 'ReportController',
    'services' => 'ServiceController',
    'superadmin' => 'SuperAdminController',
    'paymentmethods' => 'PaymentMethodController',
    'receipt' => 'ReceiptController',
];

$ctrlName = $map[$controller] ?? 'DashboardController';
$ctrlFile = __DIR__.'/../app/controllers/'.$ctrlName.'.php';
if (!file_exists($ctrlFile)) { http_response_code(404); echo 'Controller not found'; exit; }
require $ctrlFile;
$ctrl = new $ctrlName();
if (!method_exists($ctrl, $action)) { http_response_code(404); echo 'Action not found'; exit; }
$ctrl->$action($id);
