<?php

class DBConnection
{
    public static function getDBH(): PDO
    {
        $host = 'localhost';
        $db = 'alkohole';
        $user = 'root';
        $pass = 'admin';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,];
        return new PDO($dsn, $user, $pass, $opt);
    }
}