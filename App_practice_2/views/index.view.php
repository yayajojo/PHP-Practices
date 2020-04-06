<?php require('partials/head.php'); ?>


<?php foreach($todos as $key=>$obj):?>
<li><?=$obj->todo?></li>
<li><?= $obj->complete?"Completed":"Uncompleted"?></li>
<?php endforeach?>
<form action="/task" method="POST">
    <h1>SUBMIT YOUR TASK</h1>
    <input type="text" name="todo">
    <br>
    <input type="number" name="complete" min="0" max="1">
    <button type="submit">submit</button>
</form>

<?php require('partials/footer.php'); ?>
