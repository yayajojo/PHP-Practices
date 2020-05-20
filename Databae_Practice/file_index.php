<?php include('database.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/public/styles.css">
</head>

<body>
  <div class="box" id="heading">
    <h1> <?= $listTitle; ?> </h1>
  </div>

  <div class="box">
    <form method="post">
      <?php if (empty($newListItems)) : ?>
        <p> No Todos</p>
      <?php else : ?>

        <?php foreach ($newListItems as $key => $item) : ?>
          <div class="item">
            <input type="checkbox" name='deleteItem[]' value=<?= $key ?>>
            <p><?= $item ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <button type="submit" name="list" class='del'>delete</button>
    </form>

    <form class="item" method="post">
      <input type="text" name="newItem" placeholder="New Item" autocomplete="off">
      <button type="submit" name="list">+</button>
    </form>
  </div>
</body>

</html>