
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if(isset($_SESSION['username'])): ?><li><a href="profile.php">Profile</a></li><?php endif ?>
            <li><a href="cart.php">Breads</a></li>
          </ul>
          <?php if(isset($_SESSION['username'])): ?>
          <form action="logmeout.php" method="post" class="navbar-form navbar-right">
            <button type="submit" class="btn btn-warning">Log out</button>
          </form>
          <p class="navbar-text navbar-right">Hello <?php echo $_SESSION['username'];?></p>
        <?php else: ?>
          <form action="signup.php" class="navbar-form navbar-right">
            <button type="submit" class="btn btn-success">Signup</button>
          </form>
          <form action="logmein.php" method="post" class="navbar-form navbar-right" style="float:left">
            <div class="form-group">
              <input type="text" name="username" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Log in</button>
          </form>
        <?php endif ?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
