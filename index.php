<?php
/**
 * New Vape - Application Bootstrap & Front Controller
 * Custom MVC Architecture
 */

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', __DIR__);
}

// Load Autoloader & Core Framework
require_once ROOT_PATH . '/app/Core/Autoloader.php';

// Dispatch MVC Application
$app = new \App\Core\App();
$app->run();
