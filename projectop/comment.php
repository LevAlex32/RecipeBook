<?php
 require_once('db.php');
$content = $_POST['content'];
$author = $_POST['user_id'];
    
$sql = "INSERT INTO `comments` (content,user_id, publication_date) VALUES ('$content', '$author')"; 
if ($conn -> query($sql) === TRUE){
    echo "Registration complete";
}
else {
    echo "Error" . $conn->error;
    }

?>