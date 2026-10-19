<?php
namespace App\Core;

use PDO;

abstract class Model
{
    protected static $db = null;

    public static function getDB()
    {
        if (self::$db === null) {
            self::$db = Database::getInstance()->getConnection();
        }
        return self::$db;
    }
}
