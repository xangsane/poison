<?php
session_start();
?>

<html>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <?php if (isset($_SESSION['username']) && $_SESSION['type'] == 1): ?>
    <?php $breadid = $_POST['breadid'];
      $connect = pg_connect("host=localhost port=5432 dbname=op user=postgres password=1234");
      $another_query_line = "SELECT * from bread WHERE breadid = $breadid";
      $another_query = pg_query($connect,$another_query_line);
      $breadrow = pg_fetch_assoc($another_query);
      $breadname = $breadrow['breadname'];
      $breadqty = $breadrow['quantity'];
    ?>
      <div class="container">
        <?php
        $queryline = "SELECT * from users WHERE type = 0 ";
        $query = pg_query($connect,$queryline);
        ?>
        <div class="row">
          <form action="addthebread.php" method="post">
            <h3>Add <?php echo $breadname; ?> to whom?</h3>
            <?php while($row = pg_fetch_assoc($query)) : ?>
              <p><input type="radio" name = "username" value = <?php echo $row['username'] ?> > <?php echo $row['username'] ?> </p>
            <?php endwhile; ?>

            <h3>How many po? (1 - <?php echo $breadqty; ?>)</h3>
            <input type="number" name="quantity" min="1" max= "<?php echo $breadqty; ?>">
            <input type="hidden" name="breadid" value= <?php echo $breadid; ?>>
            <input type="submit" class="btn btn-default" value='Add Bread'>
          </form>
        </div>
      </div>
    <?php else: ?>
      <?php include 'navbar.php'; ?>
      <div class="container">
        <h1>TSK TSK TSK BAWAL YAN!!!</h1>
      </div>
    <?php endif ?>
  </body>
</html>
