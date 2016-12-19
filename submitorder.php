<?php session_start();
  if ($_SESSION['type'] == 0) {
    $username = $_SESSION['username'];
  }
  elseif ($_SESSION['type'] == 1) {
    $username = $_POST['username'];
  }
  
  $connect = pg_connect("host=localhost port=5432 dbname=op user=postgres password=1234");
  $query = "SELECT * FROM item_cart WHERE username = '$username'";

  $ang_query = pg_query($connect,$query);
  $rows = pg_num_rows($ang_query);

  $pay_id = "SELECT * FROM history ORDER BY payid DESC LIMIT 1";
  $max = pg_query($connect,$pay_id);
  if (pg_num_rows($max) == 0) {
    $pay_id_var = 1;
  }
  else{
    $maxcart = pg_fetch_assoc($max);
    $pay_id_var = $maxcart['payid'] + 1;
  }

  $today = date("Y-m-d H:i:s");

  while ($rowsacart = pg_fetch_assoc($ang_query)) {
    $breadid = $rowsacart['breadid'];
    $qty = $rowsacart['quantity'];
    $bread_query = "SELECT * from bread WHERE breadid = $breadid";
    $the_bread_query = pg_query($connect,$bread_query);
    $bread_row = pg_fetch_assoc($the_bread_query);
    $price = $bread_row['price'];
    $bayad = $price * $qty;
    $insert_query = "INSERT INTO history values ('$username',$breadid,$pay_id_var,$qty,$bayad,'$today')";
    $delete_query = "DELETE FROM item_cart WHERE username = '$username' AND breadid = $breadid";
    pg_query($connect,$insert_query);
    pg_query($connect,$delete_query);
  }
  header("Location:profile.php")
?>
