<?php

class PDOConnection {
    protected static $pdo;

    protected function __construct() { }

    protected function __clone() { }

    public function __wakeup() {
        throw new Exception("Cannot unserialize PDOConnection.");
    }

    private static function connect() {
        $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/milktea/setting/config.ini', true);
        try {
            self::$pdo = new PDO(
                "pgsql:host=" . $config["database"]["hostname"] . ";dbname=" . $config["database"]["database_name"],
                $config["database"]["username"],
                $config["database"]["password"]
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);  
            self::$pdo->query('SET NAMES utf8');
            self::$pdo->query('SET CHARACTER SET utf8');
        } catch(PDOException $exception) {
            throw new Exception( $exception->getMessage( ) , (int)$exception->getCode( ) );
        }
        
        return self::$pdo;
    }

    public static function getConnection() {
        if (!isset(self::$pdo)) {
            return self::connect();
        }
    }
}