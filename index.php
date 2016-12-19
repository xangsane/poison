
<!DOCTYPE html>
<?php
  session_start();
  $_SESSION['previous_location'] = 'index.php';
?>
<html lang="en">
  <head>
    <?php include 'head.php'; ?>
  </head>

  <body>
    <?php include 'navbar.php'; ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello!</h1>
        <p>Buy Bread!! :D</p>
        <p><a class="btn btn-primary btn-lg" href="cart.php" role="button">Check Our Bread &raquo;</a></p>
      </div>
    </div>

    <div class="container">
      <hr>

      <footer>
        <p>&copy; 2016</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
