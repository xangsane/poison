<!DOCTYPE html>
<?php
session_start();
$_SESSION['previous_location'] = 'editprofile.php';
?>
<?php if (isset($_SESSION['username']) && $_SESSION['type'] == 0): ?>
<html>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
      <div class="container">
        <h1>Edit profile<br></h1>
        <form action="edittheprofile.php" method="post">
          <p><input type="text" name = "username" placeholder = "Username" ></p>
          <p><input type="password" name = "password" placeholder = "********" ></p>
          <p><input type="text" name = "name" placeholder = "Enter Name"></p>
          <p><input type="text" name = "email" placeholder = "Email Address"></p>
          <p><input type="text" name = "address" placeholder = "Address"></p>
          <p><input type="submit" class = "btn btn-default" value="Edit!!!"></p>
        </form>
      </div>
  </body>
</html>

<?php elseif (isset($_SESSION['username']) && $_SESSION['type'] == 1): ?>
  <?php $toEdit = $_POST['username'] ?>
  <html>
    <head>
      <?php include 'head.php'; ?>
    </head>
    <body>
      <?php include 'navbar.php'; ?>
        <div class="container">
          <h1>Edit profile of <?php echo $toEdit; ?><br></h1>
          <form action="edittheprofile.php" method="post">
            <p><input type="text" name = "username" placeholder = "Username" ></p>
            <p><input type="password" name = "password" placeholder = "********" ></p>
            <p><input type="text" name = "name" placeholder = "Enter Name"></p>
            <p><input type="text" name = "email" placeholder = "Email Address"></p>
            <p><input type="text" name = "address" placeholder = "Address"></p>
            <input type="hidden" name="prev_username" value = <?php echo $toEdit; ?>>
            <p><input type="submit" class = "btn btn-default" value="Edit!!!"></p>
          </form>
           <a href="profile.php" class="btn btn-default" role="button">Go Back</a>
        </div>
    </body>
  </html>

<?php else: ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <div class="container">
      <h1>TSK TSK TSK BAWAL YAN!!!</h1>
    </div>
  </body>
</html>
<?php endif ?>
