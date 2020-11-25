function Player() {
    this.x = 0;
    this.y = (canvas.height - this.height)/2;
    this.width = 10;
    this.height = 100;
    this.speed = 10
    this.score = 0;

    this.draw = function() {
        context.fillStyle = "#86c06c";
        context.fillRect(this.x, this.y, (this.x+this.width), (this.y+this.height));
    }

    this.test = function () {
        console.log('workdinging bitch');
    }

    this.update = function(direction) {
        switch(direction) {
            case 'UP':
                this.x -= this.speed;
                break;
            case 'DOWN':
                this.x += this.speed;
                break;
        }
    }

    this.getScore = function() {
        return this.score;
    }
}