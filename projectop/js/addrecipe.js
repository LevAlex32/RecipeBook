
const textareaI = document.getElementById('Ingridients');


textareaI.addEventListener('keydown', function(event) {
 
	if (event.shiftKey && event.key === 'Enter') {
    

		event.preventDefault();
    
   
    		this.value += '\n';
  

		}

	});

const textareaR = document.getElementById('Recipe');


textareaR.addEventListener('keydown', function(event) {
 
	if (event.shiftKey && event.key === 'Enter') {
    

		event.preventDefault();
    
   
    		this.value += '\n';
  

		}

	});