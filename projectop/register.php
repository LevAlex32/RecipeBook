<?php
 require_once('db.php');
$login = $_POST['username'];
$pass = $_POST['password'];
$repeatpass = $_POST['repeatpassword'];
$email = $_POST['email'];

  if($password != $repeatpassword){
        echo "Password ans Repeat password should be same";
    } else {    
$sql = "INSERT INTO `users` (username,password,email) VALUES ('$login', '$password', '$email')"; 
if ($conn -> query($sql) === TRUE){
    echo "Registration complete";
}
else {
    echo "Error" . $conn->error;
    }

    }

?>