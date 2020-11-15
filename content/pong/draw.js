const canvas = document.querySelector(".canvas");
const context = canvas.getContext("2d");
const scale = 10;
const rows = canvas.height / scale;
const columns = canvas.width / scale;

let ball;
let player1, player2;

(function setup() {
    scaleEnvironment();
    ball = new Ball();

    ball.centerSpot();
    ball.draw();

    window.setInterval(() => {
        context.clearRect(0, 0, canvas.width, canvas.height);

        ball.centerSpot();
        ball.draw();

        document.querySelector('.current-score').innerText = 'Score: ' + snake.size;
    }, 250);
}());

window.addEventListener('keydown', ((e) => {
    const keyInput = e.key.replace('Arrow', '');
    snake.changeDirection(keyInput);
}));

window.addEventListener('resize', scaleEnvironment(), false);

function scaleEnvironment() {
    let containerWidth = 500;
    containerWidth = document.querySelector('.environment-container').offsetWidth;
    context.canvas.width = containerWidth;
    context.canvas.height = containerWidth;

    document.querySelector('.project-container').style.height = containerWidth + 50 + 'px';
}