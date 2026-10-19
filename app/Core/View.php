<?php
namespace App\Core;

class View
{
    public static function render($view, $data = [])
    {
        extract($data);
        $baseDir = dirname(dirname(__DIR__)) . '/views/';
        $relative = str_replace('.', '/', $view) . '.php';

        $viewFile = $baseDir . $relative;

        if (!file_exists($viewFile)) {
            if (file_exists($baseDir . 'front/' . $relative)) {
                $viewFile = $baseDir . 'front/' . $relative;
            } elseif (file_exists($baseDir . 'errors/' . $relative)) {
                $viewFile = $baseDir . 'errors/' . $relative;
            } else {
                http_response_code(404);
                echo "<h1>404 - View [{$view}] not found.</h1>";
                return;
            }
        }

        require $viewFile;
    }
}
