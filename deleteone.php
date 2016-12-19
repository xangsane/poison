<!-- check kung 1 na lang yung stock
kung 1 na lang delete, kung hindi update cart + inventory-->

<?php
  session_start();
  include 'connectdb.php';
  $breadid = $_POST['breadid'];
  if ($_SESSION['type'] == 0) {
    $username = $_SESSION['username'];
  }
  elseif ($_SESSION['type'] == 1) {
    $username = $_POST['username'];
  }
  $connect = pg_connect(pg_connections());
  $query = "SELECT * FROM item_cart WHERE username = '$username' AND breadid = $breadid ";
  $ang_query = pg_query($connect,$query);
  $rowsacart = pg_fetch_assoc($ang_query);
  $quantity_sa_cart = $rowsacart['quantity'];
  if ($quantity_sa_cart == 1) {
    $isapangquery = "SELECT * FROM bread where breadid = $breadid";
    $ang_isapangquery = pg_query($connect,$isapangquery);
    $row = pg_fetch_assoc($ang_isapangquery);
    $quantity = $row['quantity'] + 1;
    $delete_query = "DELETE FROM item_cart WHERE username = '$username' AND breadid = $breadid";
    $update_query = "UPDATE bread SET quantity = $quantity WHERE breadid = $breadid";
    pg_query($connect,$delete_query);
    pg_query($connect,$update_query);
  }
  else {
    $quantity_sa_cart = $quantity_sa_cart - 1;
    $isapangquery = "SELECT * FROM bread where breadid = $breadid";
    $ang_isapangquery = pg_query($connect,$isapangquery);
    $row = pg_fetch_assoc($ang_isapangquery);
    $quantity = $row['quantity'] + 1;
    $update_query_cart = "UPDATE item_cart SET quantity = $quantity_sa_cart WHERE username = '$username' AND breadid = $breadid";
    $update_query = "UPDATE bread SET quantity = $quantity WHERE breadid = $breadid";
    pg_query($connect,$update_query_cart);
    pg_query($connect,$update_query);
  }
  header("Location:profile.php")
  // $quantity_sa_cart = $quantity_sa_cart + 1;
  // $isapangquery = "SELECT * FROM bread where breadid = $breadid";
  // $ang_isapangquery = pg_query($connect,$isapangquery);
  // $row = pg_fetch_assoc($ang_isapangquery);
  // $quantity = $row['quantity'] - 1;
  // $presyo = $quantity_sa_cart * $row['price'];
  // $update_query_cart = "UPDATE item_cart SET quantity = $quantity_sa_cart, total = $presyo WHERE username = '$username' AND breadid = $breadid";
  // $update_query = "UPDATE bread SET quantity = $quantity WHERE breadid = $breadid";
  // pg_query($connect,$update_query_cart);
  // pg_query($connect,$update_query);
?>
