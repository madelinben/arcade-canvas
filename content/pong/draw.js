const canvas = document.querySelector(".canvas");
const context = canvas.getContext("2d");

let ball;
let playerOne;
let playerTwo;

(function render() {
    init();

    ball = new Ball();

    playerOne = new Player();
    playerTwo = new Player();

    let playerTurn = true;
    ball.center();
    ball.angle();

    window.setInterval(() => {
        clear();
        lineDash(canvas.width/2, 0, canvas.width/2, canvas.height, 10, 'black');

        // text(String.valueOf(playerOne.score), canvas.width/4, 10);
        // text(String.valueOf(playerTwo.score), 3*(canvas.width/4), 10);

        if (ball.score()) {
            playerTurn = !playerTurn;
            ball.center();
            ball.angle(playerTurn);
        }

        ball.draw();
        ball.update();
    }, 250);

}());

// EVENTS

window.addEventListener('keydown', ((e) => {
    const keyInput = e.key.replace('Arrow', '');
    console.log(keyInput);
}));

//SKETCH

function clear() {
    context.clearRect(0, 0, canvas.width, canvas.height);
}

function line(x1, y1, x2, y2, thickness, color) {
    context.beginPath();
    context.moveTo(x1, y1);
    context.lineTo(x2, y2);
    context.lineWidth = thickness;
    context.strokeStyle = color;
    context.stroke();
}

function lineDash(x1, y1, x2, y2, thickness, color) {
    context.setLineDash([3,6]);
    line(x1, y1, x2, y2, thickness, color);
}

function rect(x1, y1, x2, y2, color) {
    context.fillStyle = color;
    context.fillRect(x1, y1, x2, y2);
}

function ellipse(x, y, radius) {
    context.beginPath();
    context.arc(x, y, radius, 0, 2 * Math.PI); //anticlockwise
    context.stroke();
}

function text(content, x, y) {
    context.font = "30px Arial";
    context.fillText(content, x, y);
}

// ENVIRONMENT SETUP & SCALE

window.addEventListener('resize', init, false);

function init() {
    let containerWidth = 500;
    containerWidth = document.querySelector('.environment-container').offsetWidth;
    context.canvas.width = containerWidth;
    context.canvas.height = containerWidth;

    document.querySelector('.project-container').style.height = containerWidth + 50 + 'px';
}