<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.html"); 
    exit();
}

$about = ''; // Инициализация переменной $about
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];
    $about = $_POST['About'];

    // Проверяем, что хотя бы одно из полей заполнено
    if (!empty($username) || !empty($about) || isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
        if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES['Image']['tmp_name']);
        $image = $conn->real_escape_string($image);

        $sql = "UPDATE `users` SET username = '$username', About = '$about', Photo = '$image' WHERE id = '{$_SESSION['user_id']}'";
        $result = $conn->query($sql);

        if ($result === TRUE) {
            echo "Данные профиля успешно обновлены.";
        } else {
            echo "Ошибка при обновлении данных профиля: " . $conn->error;
        }
    } else {
        echo "Нет данных для обновления профиля.";
    }
}
    $sqli = "SELECT * FROM `users` WHERE id='{$_SESSION['user_id']}'";
    $result = $conn->query($sqli);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image = base64_encode($row['Photo']);
        $about = $row['About'];
    } else {
        echo "Ошибка при получении данных пользователя.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/recipe.css">  
    <title><?php echo $_SESSION['username']; ?></title>
    <style>
	    .edit-profile-form {
		    display: none;
	    }
    </style>
</head>
<body>
    <h2>Профиль пользователя: <?php echo $_SESSION['username']; ?></h2>
    <img src="data:image/jpeg;base64, <?php echo $image ?? ''; ?>" alt="Фото профиля">
    <p>О пользователе: <?php echo $about; ?></p>
    <button onclick="toggleForm()">Изменить профиль</button>   

    <form action="" method="post" enctype="multipart/form-data" class="edit-profile-form">
        <label for="Username">Username</label>
        <input type="text" id="Username" name="Username">
        <br>
        <label for="Image">Image</label>
        <input type="file" id="Image" name="Image">
        <br>
        <label for="About">About</label>
        <textarea id="About" name="About" rows="10" cols="50" wrap="soft"></textarea>
        <br>
        <button type="submit">Сохранить изменения</button>
    </form>

    <a href="logout.php">Выйти</a>

    <footer class="footer">        
        <ul>            
            <li><a href="#">Политика конфиденциальности</a></li>            
            <li><a href="#">Пользовательское соглашение</a></li>            
            <li><a href="#">Обратная связь</a></li>
        </ul>    
    </footer>
<script>
    function toggleForm() {
        var form = document.querySelector('.edit-profile-form');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
</body>
</html>
