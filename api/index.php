<?php

define('LARAVEL_START', microtime(true));

$root = dirname(__DIR__);
$storage = sys_get_temp_dir() . '/nexora-storage';
$cache = $storage . '/bootstrap/cache';

$directories = [
    $storage,
    $storage . '/app',
    $storage . '/app/public',
    $storage . '/app/private',
    $storage . '/framework',
    $storage . '/framework/cache/data',
    $storage . '/framework/sessions',
    $storage . '/framework/views',
    $storage . '/logs',
    $cache,
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0775, true);
    }
}

$environment = [
    'APP_CONFIG_CACHE' => $cache . '/config.php',
    'APP_EVENTS_CACHE' => $cache . '/events.php',
    'APP_PACKAGES_CACHE' => $cache . '/packages.php',
    'APP_ROUTES_CACHE' => $cache . '/routes.php',
    'APP_SERVICES_CACHE' => $cache . '/services.php',
    'VIEW_COMPILED_PATH' => $storage . '/framework/views',
    'MYSQL_ATTR_SSL_CA' => $root . '/certs/isrgrootx1.pem',
];

foreach ($environment as $key => $value) {
    putenv($key . '=' . $value);
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

require $root . '/vendor/autoload.php';

$app = require_once $root . '/bootstrap/app.php';

$app->useStoragePath($storage);

$app->handleRequest(
    Illuminate\Http\Request::capture()
);