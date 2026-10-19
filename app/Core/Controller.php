<?php
namespace App\Core;

abstract class Controller
{
    public function render($view, $data = [])
    {
        View::render($view, $data);
    }

    public function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

    public function redirect($url)
    {
        redirect($url);
    }
}
