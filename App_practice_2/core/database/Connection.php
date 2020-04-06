<?php
namespace App\Core\Database;
use PDO;

class Connection
{
    public static function make($config)
    {
        try {
            return new PDO(
                $config['connection'].':dbname='.$config['name'].';host='.$config['hostname'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}