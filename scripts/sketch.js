// import { Animation } from "../../scripts/sketch.js";
// const sketch = new Animation();
//
// sketch.test();
// sketch.init();
// window.addEventListener('resize', sketch.scale(), false);
//
// (function render() {
//     window.setInterval(() => {  }, 250);
// }());

export class Animation {
    init() {
        this.canvas = document.querySelector(".canvas");
        this.context = this.canvas.getContext("2d");
    }

    canvas() {
        return this.canvas;
    }

    scale() {
        let containerWidth = 500;
        containerWidth = document.querySelector('.environment-container').offsetWidth;
        this.context.canvas.width = containerWidth;
        this.context.canvas.height = containerWidth;
        document.querySelector('.project-container').style.height = containerWidth + 50 + 'px';
    }

    clear() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    }

    line(x1, y1, x2, y2, thickness, color) {
        this.context.beginPath();
        this.context.moveTo(x1, y1);
        this.context.lineTo(x2, y2);
        this.context.lineWidth = thickness;
        this.context.strokeStyle = color;
        this.context.stroke();
    }

    rect(x1, y1, x2, y2, color) {
        this.context.fillStyle = color;
        this.context.fillRect(x1, y1, x2, y2);
    }

    rectOutline(x1, y1, x2, y2) {
        this.context.beginPath();
        this.context.rect(x1, y1, x2, y2);
        this.context.stroke();
    }

    ellipse(x, y, radius) {
        this.context.beginPath();
        this.context.arc(x, y, radius, 0, 2 * Math.PI); //anticlockwise
        this.context.stroke();
    }

    test() {
        console.log('Sketch Module has imported!')
    }
}