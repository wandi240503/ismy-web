<?php

define('LARAVEL_START', microtime(true));

try {
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

    if (file_exists($bundledDb) && filesize($bundledDb) > 0) {
        if (!file_exists($sqlitePath) || filesize($sqlitePath) < filesize($bundledDb)) {
            @copy($bundledDb, $sqlitePath);
        }
    } else {
        if (!file_exists($sqlitePath)) {
            @touch($sqlitePath);
        }
    }

    // 3. Set environment variable for storage, maintenance driver, and database
    if ((isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
        (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on')) {
        $_SERVER['HTTPS'] = 'on';
        $_SERVER['SERVER_PORT'] = '443';
    }

    putenv("APP_STORAGE={$storagePath}");
    $_ENV['APP_STORAGE'] = $storagePath;
    $_SERVER['APP_STORAGE'] = $storagePath;

    putenv("APP_MAINTENANCE_DRIVER=file");
    $_ENV['APP_MAINTENANCE_DRIVER'] = 'file';
    $_SERVER['APP_MAINTENANCE_DRIVER'] = 'file';

    putenv("SESSION_DRIVER=file");
    $_ENV['SESSION_DRIVER'] = 'file';
    $_SERVER['SESSION_DRIVER'] = 'file';

    if (!getenv('APP_KEY')) {
        putenv("APP_KEY=base64:DfqxP4pZlkL/m85AABaZMgC0K6AVKAMnA9TtRq4lFfc=");
        $_ENV['APP_KEY'] = 'base64:DfqxP4pZlkL/m85AABaZMgC0K6AVKAMnA9TtRq4lFfc=';
        $_SERVER['APP_KEY'] = 'base64:DfqxP4pZlkL/m85AABaZMgC0K6AVKAMnA9TtRq4lFfc=';
    }

    // Auto-fallback to SQLite on Vercel
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
    /** @var \Illuminate\Foundation\Application $app */
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // 6. Bind storage path
    $app->useStoragePath($storagePath);

    // 7. Auto-migrate & seed SQLite if tables or records do not exist yet
    $app->booted(function () {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('beritas')) {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('anggotas')) {
                if (!\App\Models\Anggota::where('nomor_anggota', 'ISMY-00003')->exists()) {
                    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
                }
            }
        } catch (\Throwable $e) {
            // Log or ignore
        }
    });

    // 8. Handle Request
    $app->handleRequest(\Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    header("Content-Type: text/plain; charset=utf-8");
    echo "=== VERCEL LARAVEL BOOT EXCEPTION ===\n";
    echo "Class: " . get_class($e) . "\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
    exit;
}
