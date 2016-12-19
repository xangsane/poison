<?php
session_start();
include 'connectdb.php';
$_SESSION['previous_location'] = 'profile.php';
// echo $_SESSION['username'];
$username = $_SESSION['username'];
$connect = pg_connect(pg_connections());
$query = "SELECT * FROM users WHERE username = '$username'";
$ang_query = pg_query($connect,$query);
$row = pg_fetch_assoc($ang_query);
$cart_query = "SELECT * FROM item_cart WHERE username = '$username'";
$ang_cart_query = pg_query($connect,$cart_query);
?>

<!-- ayusin mo na lang :)) -->
<!DOCTYPE html>
<html>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <?php if(isset($_SESSION['username'])): ?>
    <?php include 'navbar.php'; ?>
    <div class="container">
      <div class="row">
			<div class="col-lg-4">
        <h1>PROFILE!!!!</h1>
			  <h4><b>name: </b><?php echo $row['name']; ?></h4>
			  <p><b>address:</b> <?php echo $row['address']; ?></p>
			  <p><b>email:</b> <?php echo $row['email']; ?></p>
      <?php if($_SESSION['type'] == 0): ?>  <a href="editprofile.php" class="btn btn-default" role="button">Edit Profile</a><?php endif ?>
			</div>
      </div>
      <?php if ($_SESSION['type'] == 0): ?>
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
          <input type="hidden" name="breadid" value = <?php echo $ang_bread_id; ?> >
        </form>
      </div>
      <div class="col-lg-2">
        <form action = 'deleteall.php' method = 'POST'>
          <p><input type='submit' class="btn btn-default" value='Remove all'></p>
          <input type="hidden" name="breadid" value = <?php echo $ang_bread_id; ?> >
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
        <p><input type='submit'  class="btn btn-default" value='Submit Order!!!'></p>
      </form>
    </div>
    <?php endif ?>
    <?php endif ?>
    <?php if ($_SESSION['type'] == 0): ?>
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
    <?php if ($_SESSION['type'] == 1): ?>
      <div class="row">
        <div class="col-lg-2">
          <h1>USERS</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2">
          <p><b>USERNAME:</b></p>
        </div>
        <div class="col-lg-2">
          <p><b>NAME:</b></p>
        </div>
      </div>
      <?php
        $admin_query = "SELECT * from users WHERE type = 0";
        $the_admin_query = pg_query($connect,$admin_query);
      ?>
      <?php while($user_row = pg_fetch_assoc($the_admin_query)) : ?>
      <div class="row">
        <div class="col-lg-2">
          <p><?php echo $user_row['username'] ?></p>
        </div>
        <div class="col-lg-2">
          <p><?php echo $user_row['name'] ?></p>
        </div>
        <div class="col-lg-2">
          <form action = 'editprofile.php' method = 'POST'>
            <input type="hidden" name="username" value = <?php echo $user_row['username'] ?> >
            <p><input type='submit'  class="btn btn-default" value='Edit Profile'></p>
          </form>
        </div>
        <div class="col-lg-2">
          <form action = 'vieworder.php' method = 'POST'>
            <input type="hidden" name="username" value = <?php echo $user_row['username'] ?> >
            <p><input type='submit'  class="btn btn-default" value='View Orders'></p>
          </form>
        </div>
        <div class="col-lg-2">
          <form action = 'viewhistory.php' method = 'POST'>
            <input type="hidden" name="username" value = <?php echo $user_row['username'] ?> >
            <p><input type='submit'  class="btn btn-default" value='View History'></p>
          </form>
        </div>
        <div class="col-lg-2">
          <form action = 'deleteuser.php' method = 'POST'>
            <input type="hidden" name="username" value = <?php echo $user_row['username'] ?> >
            <p><input type='submit'  class="btn btn-default" value='Delete User'></p>
          </form>
        </div>
      </div>
      <?php endwhile; ?>
    <?php endif; ?>
    </div>
    <?php else: ?>
      <?php include 'navbar.php'; ?>
        <h1>TSK TSK TSK BAWAL YAN!!!</h1>
    <?php endif ?>
  </body>
</html>
