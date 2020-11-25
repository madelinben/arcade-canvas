function Ball() {
    this.x = 0;
    this.y = 0;
    this.xSpeed = 10;
    this.ySpeed = 10;
    this.size = 10;

    this.draw = function() {
        context.fillStyle = "#86c06c";
        context.fillRect(this.x, this.y, this.size, this.size);
    }

    this.update = function() {
        this.x += this.xSpeed;
        this.y += this.ySpeed;

        if (this.x < 0 || this.x > (canvas.width-this.size)) {
            this.xSpeed *= -1;
        }
        if (this.y < 0 || this.y > (canvas.height-this.size)) {
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

    this.boundary = function () {

    }

}