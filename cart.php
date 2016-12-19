<!DOCTYPE html>

<?php   session_start();
        include 'connectdb.php';
        $_SESSION['previous_location'] = 'cart.php';
        $connect = pg_connect(pg_connections());
        if ($_SESSION['type'] == 0) {
          $query = "SELECT * FROM bread WHERE bread.quantity >= 1 ORDER BY bread.breadid ASC";
        }
        else {
          $query = "SELECT * FROM bread ORDER BY bread.breadid ASC";
        }
        $ang_query = pg_query($connect,$query);
        ?>
<html>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <div class="container">
      <div class="row">
        <?php if ($_SESSION['type'] == 1): ?>
          <h1>List of Bread: </h1>
        <?php else: ?>
          <h1>Available Bread: </h1>
        <?php endif; ?>

      </div>
    <?php while($row = pg_fetch_assoc($ang_query)) : ?>
      <div class="row">
			<div class="col-lg-2">
			  <h4><?php echo $row['breadname']; ?></h4>
			</div>
      <div class="col-lg-2" style="padding-top: 9px;">
        <p><b>in stock:</b> <?php echo $row['quantity']; ?></p>
      </div>
      <div class="col-lg-2" style="padding-top: 9px;">
        <p><b>price:</b> <?php echo $row['price']; ?></p>
      </div>
      <div class="col-lg-2">
        <?php if(isset($_SESSION['username']) && $_SESSION['type'] == 0): ?>
        <form action = 'addtocart.php' method = 'POST'>
          <p><input type='submit' class="btn btn-default" value='Add to Cart'></p>
          <p><input type="hidden" name="breadid" value=<?php echo $row['breadid']; ?> ></p>
          <p><input type="hidden" name="cost" value=<?php echo $row['price']; ?> ></p>
        </form>
        <?php elseif(isset($_SESSION['username']) && $_SESSION['type'] == 1): ?>
          <form action = 'editbread.php' method = 'POST'>
            <p><input type='submit' class="btn btn-default" value='Edit Bread'></p>
            <p><input type="hidden" name="breadid" value=<?php echo $row['breadid']; ?> ></p>
          </form>
        <?php endif ?>
      </div>
      <div class="col-lg-2">
      <?php if(isset($_SESSION['username']) && $_SESSION['type'] == 1): ?>
        <form action = 'deletebread.php' method = 'POST'>
          <p><input type='submit' class="btn btn-default" value='Delete Bread'></p>
          <p><input type="hidden" name="breadid" value=<?php echo $row['breadid']; ?> ></p>
        </form>
      <?php endif ?>
      </div>
      <div class="col-lg-2">
      <?php if(isset($_SESSION['username']) && $_SESSION['type'] == 1): ?>
        <form action = 'addbread.php' method = 'POST'>
          <p><input type='submit' class="btn btn-default" value='Add Bread to User'></p>
          <p><input type="hidden" name="breadid" value=<?php echo $row['breadid']; ?> ></p>
        </form>
      <?php endif ?>
      </div>
    </div>
    <?php endwhile; ?>
    <div class="row">
      <?php if($_SESSION['type'] == 1): ?>  <a href="newbread.php" class="btn btn-default" role="button">New Bread</a><?php endif ?>
    </div>
    </div>
  </body>
</html>
