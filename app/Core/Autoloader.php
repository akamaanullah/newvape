<?php
namespace App\Core;

class Autoloader
{
    public static function register()
    {
        // If composer autoload exists, load it
        $composerAutoload = dirname(dirname(__DIR__)) . '/vendor/autoload.php';
        if (file_exists($composerAutoload)) {
            require_once $composerAutoload;
        }

        // Custom PSR-4 fallback autoloader
        spl_autoload_register(function ($class) {
            $prefix = 'App\\';
            $baseDir = dirname(__DIR__) . '/';

            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                return;
            }

            $relativeClass = substr($class, $len);
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                require_once $file;
            }
        });

        // Load global helpers
        $helpersFile = __DIR__ . '/Helpers.php';
        if (file_exists($helpersFile)) {
            require_once $helpersFile;
        }
    }
}

// Auto-register immediately
Autoloader::register();
