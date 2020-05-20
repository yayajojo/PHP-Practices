<?php
// use mysql as database system;
include('config.php');

$listTitle = "Today's todo list";

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$todoList = new todoManagement($dbh, $todoTable);

if (!empty($_POST['newItem']) && isset($_POST['newItem'])) {
    $addedTodo = $_POST['newItem'];
    $todoList->addTodo($addedTodo);
    $newListItems = $todoList->render();
}
if (!empty($_POST['deleteItem']) && is_array($_POST['deleteItem'])) {
    $deletedTodos = $_POST['deleteItem'];
    $todoList->deleteTodo($deletedTodos);
    $newListItems = $todoList->render();
}
class todoManagement
{
    public function __construct($pdo, $table)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }
    public function addTodo($todoItem)
    {
        $sql = "INSERT INTO $this->table (todoItem) VALUES (?)";
        $this->pdo->prepare($sql)->execute([$todoItem]);
        //prevent SQLinjection;
    }
    public function deleteTodo($idArr)
    {
        foreach ($idArr as $id) {
            $sql = "DELETE FROM $this->table WHERE todoID = (?)";
            $this->pdo->prepare($sql)->execute([$id]);
            //prevent SQLinjection;
        }
    }
    public function render()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "TodoItem");
    }
}


class TodoItem
{
    public function getID()
    {
        return $this->todoID;
    }
    public function getContent()
    {
        return $this->todoItem;
    }
}
