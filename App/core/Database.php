<?php

class Database
{
    private static Database|null $instance = null;

    private PDO $connection;

    private function __construct()
    {
        $envFile = file(P_ROOT . '/.env');
        $env = [];
        foreach ($envFile as $line) {
            $keyValue = explode("=", $line);
            $env[trim($keyValue[0])] = trim($keyValue[1]);
        }

        $dsn = "mysql:dbname={$env['DATABASE_NAME']};host={$env['DB_HOST']}";
        $username = $env['USERNAME'];
        $password = $env['PASSWORD'];

        $this->connection = new PDO($dsn, $username, $password);
    }


    public static function getInstance(): Database
    {
        if (self::$instance == null)
            self::$instance = new Database();

        return self::$instance;

    }


    public function getConnection(): PDO
    {
        return $this->connection;
    }
}