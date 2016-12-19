<!DOCTYPE html>
<html>
<head>
  <?php include 'head.php'; ?>
</head>

  <body>
    <?php include 'navbar.php'; ?>
    <div class="container">
      <h1>Sign Up!<br></h1>
      <form action="signmeup.php" method="post">
        <p><input type="text" name = "username" placeholder = "Username" ></p>
        <p><input type="password" name = "password" placeholder = "********" ></p>
        <p><input type="text" name = "name" placeholder = "Enter Name"></p>
        <p><input type="text" name = "email" placeholder = "Email Address"></p>
        <p><input type="text" name = "address" placeholder = "Address"></p>
        <p><input type="submit" class = "btn btn-default" value="Sign me up!!!"></p>
      </form>
    </div>
  </body>
</html>
