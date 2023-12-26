<?php
require_once('db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
	$name = $_POST['Name'];
    
	$category = $_POST['category'];
    
	$ingridients = $_POST['Ingridients'];
    
	$recipe = $_POST['Recipe'];
    
        
	if(isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
        
		$image = file_get_contents($_FILES['Image']['tmp_name']);
        
		$image = $conn->real_escape_string($image);  
	} else {
        
		echo "Image upload failed.";
        
		exit();
    
	}

    
	if(empty($name) || empty($ingridients) || empty($recipe)) {
       
		 echo "You should fill all fields";
    
	} else {
        
		$sql = "INSERT INTO `recipes` (Name, Ingridients, Category, Recipe, Photo) VALUES ('$name', '$ingridients', '$category', '$recipe', '$image')";
        
		if ($conn->query($sql) === TRUE){
            
			$recipeId = $conn->insert_id; 	
            
			header("Location: recipe.php?id=$recipeId");
            
			exit();
        
		} else {
           
			 echo "Error: " . $conn->error;
        
		}
    
	}

}
?>