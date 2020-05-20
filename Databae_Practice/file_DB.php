<?php
// use file as database system;

$listTitle = "Today's todo list";
$fileName = "database.txt";

function renderPage($file)
{
    $content = file_get_contents($file);
    if ($content) {
        $itemData = rtrim($content, ", ");
        $itemArr = explode(", ", $itemData);
        $newItems = [];
        foreach ($itemArr as $item) {
            $assArrItem = explode("=>", $item);
            $newItems[$assArrItem[0]] = $assArrItem[1];
        }
    } else {
        $newItems = [];
    }
    return $newItems;
}


function rewrite($file, $filterArr)
{
    $resetListItems = renderPage($file);
    $revisedItems = array_filter(
        $resetListItems,
        function ($k) use ($filterArr) {
            return !in_array($k, $filterArr[0]);
        },
        ARRAY_FILTER_USE_KEY
    );
    $stringfiedItems = "";
    $handle = fopen($file, "w");
    if (!empty($revisedItems)) {
        foreach ($revisedItems as $key => $val) {
            $stringfiedItems .= "$key=>$val, ";
        };
        $stringfiedItems = rtrim($stringfiedItems, ", ");
        fwrite($handle, $stringfiedItems);
        fclose($handle);
    } else {
        fclose($handle);
    }
}



if (!empty($_POST['newItem']) && isset($_POST['newItem'])) {
    $handle = fopen($fileName, "a");
    $id = strval(mt_rand(3, 10000));
    $newItme = $_POST['newItem'];
    fwrite($handle, "$id=>$newItme, ");
    fclose($handle);
    $newListItems = renderPage($fileName);
};

if (!empty($_POST['deleteItem']) && is_array($_POST['deleteItem'])) {
    $listDeleteItem = array($_POST['deleteItem']);
    //var_dump($listDeleteItem);
    rewrite($fileName, $listDeleteItem);
    $newListItems = renderPage($fileName);
}
