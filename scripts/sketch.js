//ENVIRONMENT

/*const canvas = document.querySelector(".canvas");
const context = canvas.getContext("2d");

window.addEventListener('resize', init, false);

function init() {
    let containerWidth = 500;
    containerWidth = document.querySelector('.environment-container').offsetWidth;
    context.canvas.width = containerWidth;
    context.canvas.height = containerWidth;

    document.querySelector('.project-container').style.height = containerWidth + 50 + 'px';
}*/

// SKETCH

function clear() {
    context.clearRect(0, 0, canvas.width, canvas.height);
}

function line(x1, y1, x2, y2, thickness, color) {
    context.beginPath();
    //context.setLineDash([ ]);
    context.moveTo(x1, y1);
    context.lineTo(x2, y2);
    context.lineWidth = thickness;
    context.strokeStyle = color;
    context.stroke();
}

function lineDash(x1, y1, x2, y2, thickness, color) {
    context.save();
    context.setLineDash([3,6]);
    line(x1, y1, x2, y2, thickness, color);
    context.restore();
}

function rect(x, y, width, height, color) {
    context.fillStyle = color;
    context.fillRect(x, y, width, height);
}

function ellipse(x, y, radius) {
    context.beginPath();
    context.arc(x, y, radius, 0, 2 * Math.PI); //anticlockwise
    context.stroke();
}

function text(content, x, y, color) {
    context.font = "30px Arial";
    context.fillStyle = color;
    context.fillText(content, x, y);
}

/* MODULE LIBRARY
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

    scale() {
        let containerWidth = 500;
        containerWidth = document.querySelector('.environment-container').offsetWidth;
        this.context.canvas.width = containerWidth;
        this.context.canvas.height = containerWidth;
        document.querySelector('.project-container').style.height = containerWidth + 50 + 'px';
    }

    test() {
        console.log('Sketch Module has imported!')
    }
}*/
