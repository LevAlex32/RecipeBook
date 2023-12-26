const player = document.getElementById('player');
const scoreDisplay = document.getElementById('score');
const livesDisplay = document.getElementById('lives');
const gameContainer = document.getElementById('gameContainer');

// Начальные параметры игры
let score = 0;
let lives = 3;
let gameRunning = true;

// Функция для создания объекта (еды или нееды)
function createObject(className) {
    const object = document.createElement('div');
    object.classList.add(className);
    object.style.width = '30px';
    object.style.height = '30px';
    object.style.position = 'absolute';
    
    // Установка случайных координат для падения объекта
    const xPos = Math.floor(Math.random() * 350); // Позиция по горизонтали
    object.style.left = `${xPos}px`;
    object.style.top = '0';

    // Добавление изображения объекта (из папки img)
    const randomImageNumber = Math.floor(Math.random() * 5) + 1;
    const randomImagePath = `img/${className}${randomImageNumber}.png`;
    object.style.backgroundImage = `url(${randomImagePath})`;
    object.style.backgroundSize = 'cover';
    
    // Добавление объекта на игровое поле
    gameContainer.appendChild(object);
    
    // Анимация падения объекта
    function fall() {
        if (!gameRunning) return;
        const rectObject = object.getBoundingClientRect();
        const rectPlayer = player.getBoundingClientRect();
        
        // Проверка столкновения объекта с игроком
        if (rectObject.bottom >= rectPlayer.top && rectObject.right >= rectPlayer.left && rectObject.left <= rectPlayer.right) {
            if (className === 'edible') {
                score++;
                scoreDisplay.textContent = `Очки: ${score}`;
            } else if (className === 'inedible') {
                lives--;
                livesDisplay.textContent = `Жизни: ${lives}`;
                if (lives === 0) {
                    endGame();
                    return;
                }
            }
            object.remove();
            return;
        }
        
        // Удаление объекта, если он упал за пределы поля
        if (rectObject.bottom < gameContainer.getBoundingClientRect().bottom) {
            object.style.top = `${rectObject.top + 10}px`; // Изменили значение yPos +=
            requestAnimationFrame(fall);
        } else {
            object.remove();
        }
    }
    requestAnimationFrame(fall);
}

// Создание объектов каждые 1.5 секунды
const objectInterval = setInterval(() => {
    const objectTypes = ['edible', 'inedible'];
    const randomObjectType = objectTypes[Math.floor(Math.random() * objectTypes.length)];
    createObject(randomObjectType);
}, 1500);

// Управление игроком
document.addEventListener('keydown', (event) => {
    if (!gameRunning) return;
    if (event.key === 'ArrowLeft') {
        movePlayerLeft();
    } else if (event.key === 'ArrowRight') {
        movePlayerRight();
    }
});

function movePlayerLeft() {
    const playerLeft = player.offsetLeft;
    if (playerLeft > 0) {
        player.style.left = `${playerLeft - 10}px`;
    }
}

function movePlayerRight() {
    const playerLeft = player.offsetLeft;
    const playerWidth = player.offsetWidth;
    const containerWidth = gameContainer.offsetWidth;
    if (playerLeft + playerWidth < containerWidth) {
        player.style.left = `${playerLeft + 10}px`;
    }
}

// Завершение игры
function endGame() {
    gameRunning = false;
    clearInterval(objectInterval);
    const gameOverMenu = document.createElement('div');
    gameOverMenu.innerHTML = `<h2>Игра окончена</h2><p>Очки: ${score}</p><button onclick="restartGame()">Начать заново</button>`;
    gameContainer.appendChild(gameOverMenu);
}

// Начать игру заново
function restartGame() {
    gameRunning = true;
    gameContainer.innerHTML = '';
    score = 0;
    lives = 3;
    scoreDisplay.textContent = `Очки: ${score}`;
    livesDisplay.textContent = `Жизни: ${lives}`;
    objectInterval = setInterval(() => {
        const objectTypes = ['edible', 'inedible'];
        const randomObjectType = objectTypes[Math.floor(Math.random() * objectTypes.length)];
        createObject(randomObjectType);
    }, 1500);
}
