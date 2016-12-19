<?php
session_start();
$connect = pg_connect("host=localhost port=5432 dbname=op user=postgres password=1234");

$username = $_POST['username'];
$pass = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];

$query = "INSERT INTO users values ('$username','$name','$address','$email',0,'$pass')";
pg_query($connect,$query);

header("Location:index.php")
?>
