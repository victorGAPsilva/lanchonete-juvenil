<?php
declare(strict_types=1);

use App\Core\Csrf;
use App\Core\Session;

function config(?string $key = null, mixed $default = null): mixed
{
    $config = $GLOBALS['app_config'] ?? [];

    if ($key === null) {
        return $config;
    }

    foreach (explode('.', $key) as $segment) {
        if (!is_array($config) || !array_key_exists($segment, $config)) {
            return $default;
        }

        $config = $config[$segment];
    }

    return $config;
}

function db_config(?string $key = null, mixed $default = null): mixed
{
    $config = $GLOBALS['db_config'] ?? [];

    if ($key === null) {
        return $config;
    }

    foreach (explode('.', $key) as $segment) {
        if (!is_array($config) || !array_key_exists($segment, $config)) {
            return $default;
        }

        $config = $config[$segment];
    }

    return $config;
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function money(float|int|string $value): string
{
    return 'R$ ' . number_format((float) $value, 2, ',', '.');
}

function asset(string $path = ''): string
{
    return '/' . ltrim('assets/' . ltrim($path, '/'), '/');
}

function url(string $path = ''): string
{
    return '/' . ltrim($path, '/');
}

function old(string $key, mixed $default = ''): mixed
{
    $old = Session::get('old_input', []);

    return $old[$key] ?? $default;
}

function flash(string $key, mixed $default = null): mixed
{
    return Session::flash($key, $default);
}

function csrf_token(): string
{
    return Csrf::token();
}

function csrf_field(): string
{
    return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
}
