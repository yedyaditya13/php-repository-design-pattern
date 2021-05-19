<?php

namespace Config {

    use PDO;

    class Database {

        static function getConnection(): PDO
        {
            $host = 'localhost';
            $port = '3306';
            $username = 'root';
            $dbname = 'practice';
            $password = '';
    
            return new PDO("mysql:host=$host:$port;dbname=$dbname", $username, $password);    
        }
    }

}