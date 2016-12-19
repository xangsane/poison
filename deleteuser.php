<?php
  session_start();
  if ($_SESSION['type'] == 1) {
    $username = $_POST['username'];
    $connect = pg_connect("host=localhost port=5432 dbname=op user=postgres password=1234");
    $delete_query = "DELETE FROM users WHERE username = '$username'";
    $delete_query2 = "DELETE FROM item_cart WHERE username = '$username'";
    $delete_query3 = "DELETE FROM history WHERE username = '$username'";
    pg_query($connect,$delete_query);
    pg_query($connect,$delete_query2);
    pg_query($connect,$delete_query3);
    header("Location:profile.php");
  }
?>
