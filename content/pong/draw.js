const canvas = document.querySelector(".canvas");
const context = canvas.getContext("2d");

(function setup() {
    init();
    let ball = new Ball();
    let player1, player2;

    let playerTurn = true;
    let scored = true;
    //set balls initial angle

    window.setInterval(() => {
        clear();
        lineDash(canvas.width/2, 0, canvas.width/2, canvas.height, 10, 'black');

        if (scored) {
            //increment player score
            ball.center();
            ball.angle();
            scored = false;
        }

        ball.draw();
        ball.update();

    }, 250);

}());

// EVENTS

window.addEventListener('keydown', ((e) => {
    const keyInput = e.key.replace('Arrow', '');



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

// ENVIRONMENT SETUP & SCALE

window.addEventListener('resize', init, false);

function init() {
    let containerWidth = 500;
    containerWidth = document.querySelector('.environment-container').offsetWidth;
    context.canvas.width = containerWidth;
    context.canvas.height = containerWidth;

    document.querySelector('.project-container').style.height = containerWidth + 50 + 'px';
}