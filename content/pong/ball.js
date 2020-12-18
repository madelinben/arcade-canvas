function Ball() {
    this.x = 0;
    this.y = 0;
    this.xSpeed = 10;
    this.ySpeed = 10;
    this.size = 10;

    this.draw = function() {
        rect(this.x, this.y, this.size, this.size,"#86c06c");
    }

    this.update = function() {
        this.x += this.xSpeed;
        this.y += this.ySpeed;

        if (this.y <= 0 || (this.y + this.size)  >= canvas.height) {
            this.ySpeed *= -1;
        }
    }

    this.center = function() {
        this.x = (canvas.width)/2 - (this.size/2);
        this.y = (canvas.height)/2 - (this.size/2);
    }

    this.angle = function(turn) {
        let randAngle = 0;
        if (turn) {
            randAngle = Math.random() * (180 - 0);
        } else {
            randAngle = Math.random() * (360 - 180) + 180;
        }

        // let DEG = (randAngle * 180)/Math.PI;
        // let RAD = (randAngle * Math.PI)/180;

        this.xSpeed = 10 * Math.cos(randAngle);
        this.ySpeed = 10 * Math.sin(randAngle);
    }

    this.score = function() {
        if ((this.x + this.size) >= canvas.width) {
            playerOne.score++;
            return true;
        } else if (this.x <= 0) {
            playerTwo.score++;
            return true;
        }
    }

    this.boundary = function () {
        if (((this.x >= playerOne.x) && (this.x <= (playerOne.x + playerOne.width))) && ((this.y >= playerOne.y) && (this.y <= (playerOne.y + playerOne.height)))) {
            this.xSpeed *= -1;
        } else if ((((this.x + this.size) >= playerTwo.x) && (((this.x + this.size) <= (playerTwo.x + playerTwo.width)))) && ((this.y >= playerTwo.y) && (this.y <= (playerTwo.y + playerTwo.height)))) {
            this.xSpeed *= -1;
        }
    }
}