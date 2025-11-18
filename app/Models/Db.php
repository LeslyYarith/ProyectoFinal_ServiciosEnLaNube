<?php

class Database {

    private $connection;

    public function __construct()
    {
        $config = require __DIR__ . '/../../conf/db.php';

        $this->connection = new mysqli(
            $config['host'],
            $config['user'],
            $config['password'],
            $config['database'],
            $config['port']
        );

        if($this->connection->connect_error){
            die("Error de conexión: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
