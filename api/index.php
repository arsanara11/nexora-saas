<?php

define('LARAVEL_START', microtime(true));

$root = dirname(__DIR__);
putenv('MYSQL_ATTR_SSL_CA=' . $root . '/certs/isrgrootx1.pem');
$_ENV['MYSQL_ATTR_SSL_CA'] = $root . '/certs/isrgrootx1.pem';
$_SERVER['MYSQL_ATTR_SSL_CA'] = $root . '/certs/isrgrootx1.pem';
$storage = sys_get_temp_dir() . '/nexora-storage';

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
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0775, true);
    }
}

require $root . '/vendor/autoload.php';

$app = require_once $root . '/bootstrap/app.php';

$app->useStoragePath($storage);

$app->handleRequest(
    Illuminate\Http\Request::capture()
);