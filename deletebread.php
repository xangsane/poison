<?php
  session_start();
  $breadid = $_POST['breadid'];
  $connect = pg_connect("host=localhost port=5432 dbname=op user=postgres password=1234");
  $delete_query = "DELETE FROM bread WHERE breadid = $breadid";
  $delete_query2 = "DELETE FROM item_cart WHERE breadid = $breadid";
  $delete_query3 = "DELETE FROM history WHERE breadid = $breadid";
  pg_query($connect,$delete_query);
  pg_query($connect,$delete_query2);
  pg_query($connect,$delete_query3);
  header("Location:cart.php")
?>
