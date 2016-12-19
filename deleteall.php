<?php
  session_start();
  $breadid = $_POST['breadid'];
  if ($_SESSION['type'] == 0) {
    $username = $_SESSION['username'];
  }
  elseif ($_SESSION['type'] == 1) {
    $username = $_POST['username'];
  }
  $bilang = $_POST['bilang'];
  $connect = pg_connect("host=localhost port=5432 dbname=op user=postgres password=1234");
  $query = "SELECT * FROM item_cart WHERE username = '$username' AND breadid = $breadid";
  $ang_query = pg_query($connect,$query);
  $rowsacart = pg_fetch_assoc($ang_query);
  $quantity_sa_cart = $rowsacart['quantity'];
  $isapangquery = "SELECT * FROM bread where breadid = $breadid";
  $ang_isapangquery = pg_query($connect,$isapangquery);
  $row = pg_fetch_assoc($ang_isapangquery);
  $quantity = $row['quantity'] + $bilang;
  $delete_query = "DELETE FROM item_cart WHERE username = '$username' AND breadid = $breadid";
  $update_query = "UPDATE bread SET quantity = $quantity WHERE breadid = $breadid";
  pg_query($connect,$delete_query);
  pg_query($connect,$update_query);
  header("Location:profile.php")
?>
