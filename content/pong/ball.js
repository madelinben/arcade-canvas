function Ball() {
    this.x = 0;
    this.y = 0;
    this.xSpeed = scale;
    this.ySpeed = scale;

    this.centerSpot = function () {
        this.x = (canvas.width)/2 - (scale/2);
        this.y = (canvas.height)/2 - (scale/2);
    }

    this.draw = function () {
        context.fillStyle = "#86c06c";
        context.fillRect(this.x, this.y, scale, scale);
    }

    this.update = function () {
        this.x += this.xSpeed;
        this.y += this.ySpeed;
    }

    this.boundary = function () {

    }

}