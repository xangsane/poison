<?php
session_start();
include 'connectdb.php';
$username = $_POST['username'];
$password = $_POST['password'];

if($username&&$password){
  $connect = pg_connect(pg_connections());
  $query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
  $ang_query = pg_query($connect,$query);
  $row = pg_fetch_assoc($ang_query);
  if(pg_num_rows($ang_query) != 0){
    $_SESSION['username'] = $row['username'];
    $_SESSION['type'] = $row['type'];
  }
}
header("Location:{$_SESSION['previous_location']}");
?>
