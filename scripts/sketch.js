const canvas = document.querySelector(".canvas");
const context = canvas.getContext("2d");

(function setup() {
    scale();
    render();
}());

function scale() {
    let containerWidth = 500;
    containerWidth = document.querySelector('.environment-container').offsetWidth;
    context.canvas.width = containerWidth;
    context.canvas.height = containerWidth;
    document.querySelector('.project-container').style.height = containerWidth + 50 + 'px';
}

window.addEventListener('resize', scale(), false);

function line(x1, y1, x2, y2, thickness, color) {
    context.beginPath();
    context.moveTo(x1, y1);
    context.lineTo(x2, y2);
    context.lineWidth = thickness;
    context.strokeStyle = color;
    context.stroke();
}

function rectFill(x1, y1, x2, y2) {
    context.fillRect(x1, y1, x2, y2);
}

function rectOutline(x1, y1, x2, y2) {
    context.beginPath();
    context.rect(x1, y1, x2, y2);
    context.stroke();
}

function ellipse(x, y, radius) {
    context.beginPath();
    context.arc(x, y, radius, 0, 2 * Math.PI); //anticlockwise
    context.stroke();
}