const canvas = document.querySelector(".canvas");
const ctx = canvas.getContext("2d");
const scale = 10;
const rows = canvas.height / scale;
const columns = canvas.width / scale;
var snake;
var fruit;

(function setup() {
    snake = new Snake();
    fruit = new Fruit();

    fruit.randLocation()
    console.log(fruit)

    window.setInterval(() => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        fruit.draw();

        snake.update();
        snake.draw();
    }, 250);
}());

window.addEventListener('keydown', ((e) => {
    const keyInput = e.key.replace('Arrow', '');
    snake.changeDirection(keyInput);
}));