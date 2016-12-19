<!DOCTYPE html>
<?php session_start();
  include 'connectdb.php';
  $username = $_POST['username'];
  $connect = pg_connect(pg_connections());
  $query = "SELECT * FROM users WHERE username = '$username'";
  $ang_query = pg_query($connect,$query);
  $row = pg_fetch_assoc($ang_query);
  $cart_query = "SELECT * FROM item_cart WHERE username = '$username'";
  $ang_cart_query = pg_query($connect,$cart_query);
?>
<html>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <?php if ($_SESSION['type'] == 1): ?>
    <div class="container">
    <div class="row">
      <h1>ORDERS!!!</h1>
    </div>
    <?php $total = 0; ?>
    <?php while($cart_row = pg_fetch_assoc($ang_cart_query)) : ?>
    <div class="row">
      <?php
        $ang_bread_id = $cart_row['breadid'];
        $bread_query = "SELECT * FROM bread WHERE breadid = $ang_bread_id";
        $ang_bread_query = pg_query($connect,$bread_query);
        $bread_row = pg_fetch_assoc($ang_bread_query);
      ?>
    <div class="col-lg-2">
      <p><b>Bread: </b><?php echo $bread_row['breadname']; ?></p>
    </div>
    <div class="col-lg-3">
      <p><b>quantity:</b> <?php echo $cart_row['quantity']; ?></p>
    </div>
    <div class="col-lg-3">
      <?php $presyo = $bread_row['price'] * $cart_row['quantity'] ?>
      <p><b>price:</b> <?php echo $presyo; ?></p>
    </div>
    <div class="col-lg-2">
      <form action = 'deleteone.php' method = 'POST'>
        <p><input type='submit' class="btn btn-default" value='Remove one'></p>
        <input type="hidden" name="username" value = <?php echo $username; ?>>
        <input type="hidden" name="breadid" value = <?php echo $ang_bread_id; ?> >
      </form>
    </div>
    <div class="col-lg-2">
      <form action = 'deleteall.php' method = 'POST'>
        <p><input type='submit' class="btn btn-default" value='Remove all'></p>
        <input type="hidden" name="breadid" value = <?php echo $ang_bread_id; ?> >
        <input type="hidden" name="username" value = <?php echo $username; ?>>
        <input type="hidden" name="bilang" value=<?php echo $cart_row['quantity']; ?>>
      </form>
    </div>
    <?php $total = $total + $presyo?>
    </div>
  <?php endwhile; ?>
  <div class="row">
    <div class="col-lg-2">
      <p><b>Total:</b> <?php echo $total; ?> </p>
    </div>
  </div>
  <?php if ($total != 0): ?>
  <div class="row">
    <form action = 'submitorder.php' method = 'POST'>
      <input type="hidden" name="username" value = <?php echo $username; ?>>
      <p><input type='submit'  class="btn btn-default" value='Submit Order!!!'></p>
    </form>
  </div>
  <?php endif ?>
  <div class="row">
    <a href="profile.php" class="btn btn-default" role="button">Go Back</a>
  </div>
  </div>
  <?php endif ?>
  </body>
</html>
