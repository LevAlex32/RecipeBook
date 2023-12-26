<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cooking_helper";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if(!$conn){
die("Connection Failed".msqli_connect_error());}
else{
"Success";}
?>