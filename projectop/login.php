<?php
session_start();
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        echo "Заполните все поля";
    } else {
        $sql = "SELECT * FROM `users` WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['password'] === $password) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                echo "Добро пожаловать, " . $row['username'];
                header("Location: profile.php"); 
                exit();
            } else {
                echo "Неверный пароль";
            }
        } else {
            echo "Неверный логин или такого пользователя не существует";
        }
    }
}
?>
