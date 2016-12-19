<?php session_start();
      $breadid = $_POST['breadid'];
      $username = $_POST['username'];
      $qty = $_POST['quantity'];
      echo $breadid;
      echo "string";
      $connect = pg_connect("host=localhost port=5432 dbname=op user=postgres password=1234");
      $query = "SELECT * FROM item_cart WHERE username = '$username' AND breadid = $breadid ";
      $ang_query = pg_query($connect,$query);
      $rowsacart = pg_fetch_assoc($ang_query);
      // $isapangquery = "SELECT * FROM bread where breadid = $breadid";
      // $ang_isapangquery = pg_query($connect,$isapangquery);
      // $row = pg_fetch_assoc($ang_isapangquery);

      if (pg_num_rows($ang_query) == 0) { //kapag wala pang username at yung breadid sa table (wala pang cart or wala pang particular item sa cart)
        $insert_query = "INSERT INTO item_cart values ('$username',$breadid, $qty)";
        pg_query($connect,$insert_query);
        $isapangquery = "SELECT * FROM bread where breadid = $breadid";
        $ang_isapangquery = pg_query($connect,$isapangquery);
        $row = pg_fetch_assoc($ang_isapangquery);
        $quantity = $row['quantity'] - $qty;
        $update_query = "UPDATE bread SET quantity = $quantity WHERE breadid = $breadid";
        pg_query($connect,$update_query);
      }
      else{
        $quantity_sa_cart = $rowsacart['quantity'];
        $quantity_sa_cart = $quantity_sa_cart + $qty;
        $isapangquery = "SELECT * FROM bread where breadid = $breadid";
        $ang_isapangquery = pg_query($connect,$isapangquery);
        $row = pg_fetch_assoc($ang_isapangquery);
        $quantity = $row['quantity'] - $qty;
        $update_query_cart = "UPDATE item_cart SET quantity = $quantity_sa_cart WHERE username = '$username' AND breadid = $breadid";
        $update_query = "UPDATE bread SET quantity = $quantity WHERE breadid = $breadid";
        pg_query($connect,$update_query_cart);
        pg_query($connect,$update_query);
      }
      header("Location:cart.php")
 ?>
