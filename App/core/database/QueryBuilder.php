<?php
namespace App\Core\Database;
use PDO;
use Exception;

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    public function insertOne($parameter,$table){
        try{
        $params = implode(" , ",array_keys($parameter));
        $values = ':'.implode(" , :",array_keys($parameter));
        $sql = "insert into {$table} ($params) values ($values) ";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameter);
        return "successfully insert";}
        catch (Exception $e){
            return $e;
        }
        

    }
}