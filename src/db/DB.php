<?php

namespace Kavlar\TestItSolutions\db;

use PDO;

class DB
{
    private static array $instances = [];
    private PDO $connection;

    protected function __construct()
    {
        $this->connection = new PDO("sqlite:file:database.sqlite");
    }

    protected function __clone()
    {
    }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): DB
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function get_connect(): PDO
    {
        return $this->connection;
    }

}