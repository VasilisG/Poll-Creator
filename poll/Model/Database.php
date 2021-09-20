<?php

namespace Poll\Model;

use Poll\Config;

class Database {

    private static $connection;

    public static function getConnection() {
        if(self::$connection == null){
            self::$connection = new \PDO(
                "mysql:host=" . Config::HOSTNAME . ";"
                . "dbname=" . Config::DB_NAME,
                Config::USERNAME,
                Config::PASSWORD
            );
            self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
}