<?php
session_start();
include 'connectdb.php';
if ($_SESSION['type'] == 0) {
  $OGusername = $_SESSION['username'];
  $connect = pg_connect(pg_connections());
  $query = "SELECT * FROM users WHERE username = '$OGusername'";
  $ang_query = pg_query($connect,$query);
  $row = pg_fetch_assoc($ang_query);
}
elseif ($_SESSION['type'] == 1) {
  $OGusername = $_POST['prev_username'];
  $connect = pg_connect(pg_connections());
  $query = "SELECT * FROM users WHERE username = '$OGusername'";
  $ang_query = pg_query($connect,$query);
  $row = pg_fetch_assoc($ang_query);
}

if (empty($_POST['username'])) {
  $username = $row['username'];
}
else {
  $_SESSION['username'] = $_POST['username'];
  $username = $_POST['username'];
  $update_query_cart = "UPDATE item_cart SET username = '$username' WHERE username = '$OGusername'";
  $update_query_history = "UPDATE history SET username = '$username' WHERE username = '$OGusername'";
  pg_query($connect,$update_query_cart);
  pg_query($connect,$update_query_history);
}

if (empty($_POST['password'])) {
  $pass = $row['password'];
}
else {
  $pass = $_POST['password'];
}

if (empty($_POST['name'])) {
  $name = $row['name'];
}
else {
  $name = $_POST['name'];
}

if (empty($_POST['email'])) {
  $email = $row['email'];
}
else {
  $email = $_POST['email'];
}

if (empty($_POST['address'])) {
  $address = $row['address'];
}
else {
  $address = $_POST['address'];
}

// check niya dapat kung may laman... kung walang laman edi yung previous dapat
$query2 = "UPDATE users SET username = '$username', name = '$name', address = '$address', email = '$email', password = '$pass' WHERE username = '$OGusername'";
pg_query($connect,$query2);

header("Location:profile.php");
?>
