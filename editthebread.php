<?php
$breadid = $_POST['breadid'];
include 'connectdb.php';
$connect = pg_connect(pg_connections());
$query = "SELECT * FROM bread WHERE breadid = $breadid";
$ang_query = pg_query($connect,$query);
$row = pg_fetch_assoc($ang_query);

if (empty($_POST['breadname'])) {
  $bname = $row['breadname'];
}
else {
  $bname = $_POST['breadname'];
}

if (empty($_POST['quantity'])) {
  $qty = $row['quantity'];
}
else {
  $qty = $_POST['quantity'];
}

if (empty($_POST['price'])) {
  $price = $row['price'];
}
else {
  $price = $_POST['price'];
}

$query2 = "UPDATE bread SET breadname = '$bname', price = $price, quantity = $qty WHERE breadid = $breadid";
pg_query($connect,$query2);

header("Location:cart.php");
?>
