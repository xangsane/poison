<?php session_start();
  $username = $_POST['username'];
  $connect = pg_connect("host=localhost port=5432 dbname=op user=postgres password=1234");
  $query = "SELECT * FROM users WHERE username = '$username'";
  $ang_query = pg_query($connect,$query);
  $row = pg_fetch_assoc($ang_query);
  $cart_query = "SELECT * FROM item_cart WHERE username = '$username'";
  $ang_cart_query = pg_query($connect,$cart_query);
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <div class="container">
      <?php if ($_SESSION['type'] == 1): ?>
      <div class="row">
        <h1>HISTORY</h1>
        <?php
          $history_query = "SELECT * FROM history WHERE username = '$username' ORDER BY payid";
          $ang_history_query = pg_query($connect,$history_query);
        ?>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <p><b>DATE</b></p>
        </div>
        <div class="col-lg-3">
          <p><b>ITEM</b></p>
        </div>
        <div class="col-lg-3">
          <p><b>QUANTITY</b></p>
        </div>
        <div class="col-lg-3">
          <p><b>COST</b></p>
        </div>
      </div>
      <?php $prev_date = date("Y-m-d H:i:s") ?>
      <?php while($order_row = pg_fetch_assoc($ang_history_query)) : ?>
      <div class="row">
        <div class="col-lg-3">
          <?php if ($prev_date != $order_row['date']): ?>
          <p><?php echo $order_row['date'] ?></p>
          <?php endif; ?>
          <?php $prev_date = $order_row['date'] ?>
        </div>
        <div class="col-lg-3">
          <?php
            $yung_bread_id = $order_row['breadid'];
            $el_bread_query = "SELECT * FROM bread WHERE breadid = $yung_bread_id";
            $bread_query_to = pg_query($connect,$el_bread_query);
            $bread_row_to = pg_fetch_assoc($bread_query_to);
          ?>
          <p><?php echo $bread_row_to['breadname']; ?></p>
        </div>
        <div class="col-lg-3">
          <p><?php echo $order_row['quantity'] ?></p>
        </div>
        <div class="col-lg-3">
          <p><?php echo $order_row['cost'] ?></p>
        </div>
      </div>
      <?php endwhile; ?>
      <?php endif ?>
      <div class="row">
        <a href="profile.php" class="btn btn-default" role="button">Go Back</a>
      </div>
    </div>
  </body>
</html>
