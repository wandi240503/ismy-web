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

// 2. Prepare SQLite database in /tmp with seeded data
$sqlitePath = $storagePath . '/database.sqlite';
$bundledDb = __DIR__ . '/../database/database.sqlite';

if (!file_exists($sqlitePath)) {
    if (file_exists($bundledDb) && filesize($bundledDb) > 0) {
        @copy($bundledDb, $sqlitePath);
    } else {
        @touch($sqlitePath);
    }
}

// 3. Set environment variable for storage and database
putenv("APP_STORAGE={$storagePath}");
$_ENV['APP_STORAGE'] = $storagePath;
$_SERVER['APP_STORAGE'] = $storagePath;

// Auto-fallback to SQLite on Vercel unless a live remote PostgreSQL host (like Supabase/Neon) is configured
$dbHost = getenv('DB_HOST');
if (!$dbHost || $dbHost === '127.0.0.1' || $dbHost === 'localhost') {
    putenv("DB_CONNECTION=sqlite");
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_CONNECTION'] = 'sqlite';

    putenv("DB_DATABASE={$sqlitePath}");
    $_ENV['DB_DATABASE'] = $sqlitePath;
    $_SERVER['DB_DATABASE'] = $sqlitePath;
}

// 4. Register Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 5. Bootstrap Laravel Application
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 6. Bind storage path
$app->useStoragePath($storagePath);

// 7. Handle Request
$app->handleRequest(Request::capture());
