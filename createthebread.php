<?php
session_start();
include 'connectdb.php';
$connect = pg_connect(pg_connections());

$bread = $_POST['breadname'];
$qty = $_POST['quantity'];
$price = $_POST['price'];

$bread_id = "SELECT * FROM bread ORDER BY breadid DESC LIMIT 1";
$max = pg_query($connect,$bread_id);
if (pg_num_rows($max) == 0) {
  $pay_id_var = 1;
}
else{
  $maxcart = pg_fetch_assoc($max);
  $bread_id_var = $maxcart['breadid'] + 1;
}

$query = "INSERT INTO bread values ($bread_id_var,'$bread',$price,$qty)";
pg_query($connect,$query);

header("Location:cart.php")
?>
