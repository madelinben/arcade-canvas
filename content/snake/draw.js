const canvas = document.querySelector(".canvas");
const ctx = canvas.getContext("2d");
const scale = 10;
const rows = canvas.height / scale;
const columns = canvas.width / scale;
var snake;
var fruit;

(function setup() {
    init();
    snake = new Snake();
    fruit = new Fruit();

    fruit.randLocation()
    console.log(fruit)

    window.setInterval(() => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        fruit.draw();
        snake.update();
        snake.draw();

        if (snake.eat(fruit)) {
            fruit.randLocation();
        }

        snake.collision();

        document.querySelector('.score').innerText = 'Score: ' + snake.size;
    }, 250);
}());

window.addEventListener('keydown', ((e) => {
    const keyInput = e.key.replace('Arrow', '');
    snake.changeDirection(keyInput);
}));

window.addEventListener('resize', init, false);

function init() {
    let containerWidth = 500;
    containerWidth = document.querySelector('.environment-container').offsetWidth;

    /*document.querySelector('.project-title').innerText = containerWidth + 'px';*/

    ctx.canvas.width = containerWidth;
    ctx.canvas.height = containerWidth;
}