<!-- check if may nareturn na row
kung wala insert sa carts tapos update sa bread, kung meron update carts at update bread na din
balik sa cart

main query = SELECT * from item_cart WHERE breadid = postbreadid
if (pg_num_rows($result)==0) { PERFORM ACTION } kapag meron nireturn yung query-->
<?php session_start();
      include 'connectdb.php';
      $breadid = $_POST['breadid'];
      $breadid = (int)$breadid;
      $username = $_SESSION['username'];
      $price = $_POST['cost'];
      #echo $breadid;
      $connect = pg_connect(pg_connections());
      $query = "SELECT * FROM item_cart WHERE username = '$username' AND breadid = $breadid ";
      $ang_query = pg_query($connect,$query);
      $rowsacart = pg_fetch_assoc($ang_query);
      // $isapangquery = "SELECT * FROM bread where breadid = $breadid";
      // $ang_isapangquery = pg_query($connect,$isapangquery);
      // $row = pg_fetch_assoc($ang_isapangquery);

      if (pg_num_rows($ang_query) == 0) { //kapag wala pang username at yung breadid sa table (wala pang cart or wala pang particular item sa cart)
        // $presyo = $row['price'];
        $insert_query = "INSERT INTO item_cart values ('$username',$breadid, 1, $price)";
        pg_query($connect,$insert_query);
        $isapangquery = "SELECT * FROM bread where breadid = $breadid";
        $ang_isapangquery = pg_query($connect,$isapangquery);
        $row = pg_fetch_assoc($ang_isapangquery);
        $quantity = $row['quantity'] - 1;
        $update_query = "UPDATE bread SET quantity = $quantity WHERE breadid = $breadid";
        pg_query($connect,$update_query);
      }
      else{
        $quantity_sa_cart = $rowsacart['quantity'];
        $quantity_sa_cart = $quantity_sa_cart + 1;
        $isapangquery = "SELECT * FROM bread where breadid = $breadid";
        $ang_isapangquery = pg_query($connect,$isapangquery);
        $row = pg_fetch_assoc($ang_isapangquery);
        $quantity = $row['quantity'] - 1;
        $presyo = $quantity_sa_cart * $row['price'];
        $update_query_cart = "UPDATE item_cart SET quantity = $quantity_sa_cart, total = $presyo WHERE username = '$username' AND breadid = $breadid";
        $update_query = "UPDATE bread SET quantity = $quantity WHERE breadid = $breadid";
        pg_query($connect,$update_query_cart);
        pg_query($connect,$update_query);
      }
      header("Location:cart.php")
 ?>
