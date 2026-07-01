<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = [], string $layout = 'layouts/main'): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = APP_ROOT . '/app/Views/' . ltrim($view, '/') . '.php';

        if (!is_file($viewFile)) {
            http_response_code(404);
            echo 'View not found';

            return;
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        if ($layout === '') {
            echo $content;

            return;
        }

        $layoutFile = APP_ROOT . '/app/Views/' . ltrim($layout, '/') . '.php';

        if (is_file($layoutFile)) {
            require $layoutFile;

            return;
        }

        echo $content;
    }

    public static function partial(string $view, array $data = []): string
    {
        extract($data, EXTR_SKIP);

        $viewFile = APP_ROOT . '/app/Views/' . ltrim($view, '/') . '.php';

        ob_start();
        require $viewFile;

        return (string) ob_get_clean();
    }
}
