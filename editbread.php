<?php
session_start();
$_SESSION['previous_location'] = 'editbread.php';
?>

<html>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <?php if (isset($_SESSION['username']) && $_SESSION['type'] == 1): ?>
    <?php $breadid = $_POST['breadid']; ?>
      <div class="container">
        <h1>Edit bread<br></h1>
        <form action="editthebread.php" method="post">
          <p><input type="text" name = "breadname" placeholder = "Bread name" ></p>
          <p><input type="text" name = "quantity" placeholder = "Quantity"></p>
          <p><input type="text" name = "price" placeholder = "Price"></p>
          <p><input type="hidden" name="breadid" value = <?php echo $breadid; ?>></p>
          <p><input type="submit" class = "btn btn-default" value="Edit!!!"></p>
        </form>
      </div>
    <?php else: ?>
      <?php include 'navbar.php'; ?>
      <div class="container">
        <h1>TSK TSK TSK BAWAL YAN!!!</h1>
      </div>
    <?php endif ?>
  </body>
</html>
