<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Prepare serverless writable storage in /tmp
$storagePath = '/tmp/storage';
$directories = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    $storagePath . '/app/public',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

// 2. Set environment variable for storage
putenv("APP_STORAGE={$storagePath}");
$_ENV['APP_STORAGE'] = $storagePath;
$_SERVER['APP_STORAGE'] = $storagePath;

// 3. Register Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 4. Bootstrap Laravel Application
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 5. Bind storage path
$app->useStoragePath($storagePath);

// 6. Handle Request and send response (Laravel 11 native)
$app->handleRequest(Request::capture());
