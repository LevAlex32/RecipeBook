<?php
include 'db.php';
$recipeId = $_GET['id'];
$sql = "SELECT * FROM recipes WHERE id = $recipeId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
      
	$row = $result->fetch_assoc();
	$recipeTitle = $row['Name'];
	$recipeIngridients = $row['Ingridients'];
	$recipeRecipe = $row['Recipe'];
	$recipePhoto = $row['Photo'];
} 
else {
    
header("Location: index.html");
exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name ="viewport" content="width=device-width, inital-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/recipe.css">	
	<title><?php echo $recipeTitle; ?> </title>
</head>
<body>

<section class="header">
		<div class="header__top">
			<div class="container">
				<div class="flex__container">
					<div class="header__links">
						<div class="links__item header__vk">
							<a href="http://127.0.0.1:5500/index.html"><img src="./img/0.1.png" alt=""
									width="30px"></a>
						</div>
						<div class="links__item header__facebook">
							<a href="./testsite.html"><img src="./img/0.2.png" alt="" width="30px"></a>
						</div>
						<div class="links__item header__twitter">
							<a href="#"><img src="./img/0.3.png" alt="" width="30px"></a>
						</div>
						<div class="links__item header__telegram">
							<a href="#"><img src="./img/0.4.png" alt="" width="30px"></a>
						</div>
						<div class="links__item header__youtube">
							<a href="#"><img src="./img/0.5.png" alt="" width="30px"></a>
						</div>
						<div class="links__item header__instagram">
							<a href="#"><img src="./img/0.6.png" alt="" width="30px"></a>
						</div>
					</div>
					<div class="header__about">
						<div class="main_page header__topic"><a href="index.php">
								<h3>Главная страница</h3>
							</a></div>
						<div class="about__item header__topic"><a href="#">
								<h3>О теме</h3>
							</a></div>
						<div class="about__item header__site-map">
							<a href="#">
								<h3>Карта сайта</h3>
							</a>
						</div>
						<div class="about__item header__feedback"><a href="#">
								<h3>Обратная связь</h3>
							</a></div>
					</div>
				</div>
			</div>
		</div>

		<!-- Подлежит корректировке (желательно с помощью ul li) -->
		<div class="header__nav">
			<div class="container">
				<nav class="nav__flex">
					<a href="snacks.php">Закуски</a>
					<a href="salads.php">Салаты</a>
					<a href="soups.php">Супы</a>
					<a href="second_dishes.php">Вторые блюда</a>
					<a href="bakery.php">Выпечка</a>
					<a href="deserts.php">Десерты</a>
					<a href="drinks.php">Напитки</a>
					<a href="sauces.php">Соусы</a>
					<a href="preserves.php">Заготовки</a>
				</nav>
			</div>
		</div>

	</section>    
<header class="title">
        
<h2><?php echo $recipeTitle; ?></h2>
        
<?php if ($recipePhoto): ?>
            
<img src="data:image/jpg;base64, <?php echo base64_encode($recipePhoto); ?>" alt ="Фото рецепта">
        
<?php endif; ?>
    
</header>

    
<main class="main-content">
        
<section class="recipe-details">
           
 <h3>Ингридиенты:</h3>
            <ul>
                
<?php
                          
$ingredientsList = explode("\n", $recipeIngridients);
               
foreach ($ingredientsList as $ingredient) {
                    
echo "<li>$ingredient</li>";
                
}
                
?>
</ul>
            
<h3>Рецепт:</h3>
            
<p><?php echo nl2br($recipeRecipe); ?></p>
        
</section>
          
</main>

    
<footer class="footer">
        
<ul>
            
<li><a href="#">Политика конфиденциальности</a></li>
            
<li><a href="#">Пользовательское соглашение</a></li>
            
<li><a href="#">Обратная связь</a></li>
        </ul>

    </footer>
</body>
</html>