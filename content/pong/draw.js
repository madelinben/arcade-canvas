function render() {
    let ball = new Ball();
    let player1, player2;

    let playerTurn = true;
    let scored = true;
    //ball.setAngle(false);

    window.setInterval(() => {
        context.clearRect(0, 0, canvas.width, canvas.height);

        if (scored) {
            ball.setCenter()
            scored = false;
        }

        line(canvas.width / 2, 0, canvas.width / 2, canvas.height, 5, 'black');

        ball.draw();

        //ball.update();
        //ball.draw();

        //document.querySelector('.current-score').innerText = 'Score: ' + snake.size;
    }, 250);
}



// window.addEventListener('keydown', ((e) => {
//     const keyInput = e.key.replace('Arrow', '');
//     snake.changeDirection(keyInput);
// }));