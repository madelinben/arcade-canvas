// SETUP ENVIRONMENT

const canvas = document.querySelector(".canvas");
const context = canvas.getContext("2d");

window.addEventListener('resize', init, false);

function init() {
    let containerWidth = 500;
    containerWidth = document.querySelector('.environment-container').offsetWidth;
    context.canvas.width = containerWidth;
    context.canvas.height = containerWidth;

    document.querySelector('.project-container').style.height = containerWidth + 50 + 'px';
}

// RENDER ANIMATION

let ball;
let playerOne, playerTwo;

(function render() {
    init();

    ball = new Ball();
    playerOne = new Player();
    playerTwo = new Player();

    playerOne.x = 25;
    playerTwo.x = canvas.width-25-playerTwo.width;
    playerOne.center();
    playerTwo.center();

    ball.center();
    ball.angle();

    let playerTurn = true;

    window.setInterval(() => {
        clear();

        lineDash(canvas.width/2, 0, canvas.width/2, canvas.height, 10, 'black');

        text(playerOne.score, canvas.width/4-10, 50, 'black');
        text(playerTwo.score, 3*(canvas.width/4)-10, 50, 'black');

        if (ball.score()) {
            playerTurn = !playerTurn;
            ball.center();
            playerOne.center();
            playerTwo.center();
            ball.angle(playerTurn);
        }

        playerOne.draw();
        playerTwo.draw();

        ball.boundary();

        ball.draw();
        ball.update();
    }, 250);

}());

// EVENTS

window.addEventListener('keydown', ((e) => {
    switch(e.code) {
        case 'ArrowUp':
            playerOne.update('UP');
            break;
        case 'ArrowDown':
            playerOne.update('DOWN');
            break;
        case 'KeyW':
            playerTwo.update('UP');
            break;
        case 'KeyS':
            playerTwo.update('DOWN');
            break;
    }
}));