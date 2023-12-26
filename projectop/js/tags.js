const tagsInput = document.getElementById('Tags');

const suggestedTags = document.getElementById('suggestedTags');



tagsInput.addEventListener('input', function () {
    
	const inputText = this.value.toLowerCase();

    
	const xhr = new XMLHttpRequest();
    
	xhr.onreadystatechange = function () {
        
		if (xhr.readyState === XMLHttpRequest.DONE) {
            
			if (xhr.status === 200) {
                
				const recipes = JSON.parse(xhr.responseText);
                
				displayRecipes(recipes);
            
			} else {
                
				console.error('Произошла ошибка при получении рецептов');
            
			}
        
		}
    
	};

    
	xhr.open('GET', `get_recipes_by_tags.php?tags=${inputText}`, true);
    
	xhr.send();
});

function displayRecipes(recipes) {
    
		suggestedTags.innerHTML = '';

    
		recipes.forEach(recipe => {
        
			const recipeElement = document.createElement('div');
        
			recipeElement.classList.add('recipe');
        
			recipeElement.dataset.tags = recipe.tags; 
			const recipeText = document.createTextNode(recipe.name); 
			recipeElement.appendChild(recipeText);

        
			suggestedTags.appendChild(recipeElement);
    
	}
);
}