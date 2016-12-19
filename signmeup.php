<?php
session_start();
include 'connectdb.php';
$connect = pg_connect(pg_connections());

$username = $_POST['username'];
$pass = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];

$query = "INSERT INTO users values ('$username','$name','$address','$email',0,'$pass')";
pg_query($connect,$query);

header("Location:index.php")
?>
