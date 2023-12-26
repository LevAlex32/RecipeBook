<?php
include('db.php'); 

$query = "SELECT id, Name, Category, Photo FROM recipes WHERE Category = 'Вторые_блюда'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Ошибка запроса: " . mysqli_error($conn));
}

$category = '';
$recipes = array(); // Создаем массив для хранения рецептов

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $category = $row["Category"];
        $recipeId = $row["id"];
        $title = $row["Name"];
	$recipePhoto = $row['Photo'];
        $recipes[] = array(
'id' => $recipeId,
    'title' => $title,
    'category' => $category,
    'Photo' => $recipePhoto);
    }
} else {
    echo "Нет рецептов в категории 'Вторые блюда'.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/category.css">
	<title><?php echo $category; ?></title>
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
						<div class="about__item add_recipe"><a href="addrecipe.html">
								<h3>Добавить рецепт</h3>
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

	<main class="main">
    
		<div class="recipe-container">
        
			<?php foreach ($recipes as $recipe) { ?>
            
				<div class="recipe-item">
                
					<a href="recipe.php?id=<?php echo $recipe['id']; ?>" class="recipe-link">
                    
						<div class="recipe-image">
                       
					 		<img src="data:image/jpg;base64, <?php echo base64_encode($recipe['Photo']); ?>" alt="Фото рецепта <?php echo $recipe['id']; ?>">
						</div>
                    
						<div class="recipe-details">
                        
							<h3 class="recipe-title"><?php echo $recipe['title']; ?></h3>
                    
						</div>
                
					</a>
            
				</div>
        
			<?php } ?>
    
		</div>
	
</main>

	<footer class="footer">
		<div class="container">
			<div class="footer__widget">
				<div class="widget first-item">
					<div class="widget__img">
						<a target='_blank' href="http://cookit.demo.wpshop.tech/"><img src="./css/img/0.0.png"
								alt=""></a>
					</div>
					<div class="widget__info">
						<ul>
							<li>На нашем сайте используются cookie <p>для сбора статистической информации.</p>
							</li>
							<li><a href="#">Политика конфиденциальности</a></li>
							<li><a href="#">Пользовательское соглашение</a></li>
						</ul>
					</div>

				</div>
				<div class="widget second-item">
					<div class="widget__title">Рецепты по категориям</div>
					<div class="widget__nav">
						<ul>
							<li><a href="./salats.phpl">Салаты</a></li>
							<li><a href="./soups.php">Супы</a></li>
							<li><a href="./second_dishes.php">Вторые блюда</a></li>
							<li><a href="./bakery.php">Выпечка</a></li>
							<li><a href="./dessert.php">Десерты</a></li>
						</ul>
					</div>
				</div>
				<div class="widget third-item">
					<div class="widget__title">О проекте</div>
					<div class="widget__nav">
						<ul>
							<li><a href="#">Обратная связь</a></li>
							<li><a href="#">Карта сайта</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer__copyright">
				<h4> &copy; 2023 Копирование материалов строго запрещено.
				</h4>
			</div>
		</div>
	</footer>
</body>

</html>
