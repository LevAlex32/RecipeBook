<?php
    
		require_once('db.php'); 
    
		$sql = "SELECT tage_name FROM tags"; 
    
		$result = $conn->query($sql);

    
		if ($result->num_rows > 0) {
        
			while ($row = $result->fetch_assoc()) {
           
				echo '<span class="tag">#' . htmlspecialchars($row["tag_name"]) . '</span>';
        
			}
    
		} else {
        
			echo "0 результатов";
    
		}
    
		?>
