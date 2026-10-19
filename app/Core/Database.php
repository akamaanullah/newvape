<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $pdo = null;

    private function __construct()
    {
        $config = config('database.connections.mysql');
        if (!$config) return;

        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";

        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password'], $config['options'] ?? []);
        } catch (PDOException $e) {
            // Log connection error or handle gracefully
            if (config('app.debug')) {
                // In debug mode we can allow execution to continue if DB is not installed yet
                error_log("Database connection error: " . $e->getMessage());
            }
            $this->pdo = null;
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getConnection()
    {
        return self::getInstance()->pdo;
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    private function __clone() {}
    public function __wakeup() {}
}
