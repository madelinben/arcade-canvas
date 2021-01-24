const canvas = document.querySelector(".canvas");
const context = canvas.getContext("2d");
const scale = 10;
const rows = canvas.height / scale;
const columns = canvas.width / scale;
let snake;
let fruit;

(function setup() {
    init();
    snake = new Snake();
    fruit = new Fruit();

    fruit.randLocation()

    window.setInterval(() => {
        context.clearRect(0, 0, canvas.width, canvas.height);

        fruit.draw();
        snake.update();
        snake.draw();

        if (snake.eat(fruit)) {
            fruit.randLocation();
        }

        snake.collision();

        document.querySelector('.current-score').innerText = 'Score: ' + snake.size;
    }, 250);
}());

window.addEventListener('keydown', ((e) => {
    const keyInput = e.key.replace('Arrow', '');
    snake.changeDirection(keyInput);
}));

window.addEventListener('resize', init, false);

function init() {
    context.canvas.height = context.canvas.width;
    document.querySelector('.environment-container').style.height = context.canvas.width;
}
