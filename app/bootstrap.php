<?php
declare(strict_types=1);

define('APP_ROOT', dirname(__DIR__));

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = APP_ROOT . '/app/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require_once $file;
    }
});

require_once APP_ROOT . '/app/Core/helpers.php';

$GLOBALS['app_config'] = require APP_ROOT . '/config/app.php';
$GLOBALS['db_config'] = require APP_ROOT . '/config/database.php';
