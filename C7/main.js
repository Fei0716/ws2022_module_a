const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
let balls = [];
let mouse = {
    x: undefined,
    y: undefined,
    lastX: undefined,
    lastY: undefined,
};
const colors = [
    '#845EC2',
    '#D65DB1',
    '#FF6F91',
    '#FF9671',
    '#FFC75F',
    '#F9F871',
];
let mouseMoveTimer;
// Add event listener for mousemove
window.addEventListener('mousemove', function(e) {
    mouseMove(e);
});

setInterval(generateTrail , 20);
function generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
function generateTrail() {
    // if mouse not moving
        if(mouse.lastX == mouse.x && mouse.lastY == mouse.y){
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            return;
        }
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        if(mouse.x != undefined && mouse.y != undefined){
            balls.push(new createCircles());
        }
        // clear the canvas
        if (balls.length > 20) {
            balls = balls.slice(1);
        }
        mouse.lastX = mouse.x;
        mouse.lastY = mouse.y;
        drawCircles();    


    
}
function createCircles() {
    if (mouse.x !== undefined && mouse.y !== undefined) {

        this.r = generateRandomNumber(10, 20);
        this.x = mouse.x + generateRandomNumber(-30, 30);
        this.y = mouse.y + generateRandomNumber(-30, 30);
        this.color = colors[generateRandomNumber(0, colors.length - 1)];
        this.draw = function () {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI);
            ctx.fillStyle = this.color;
            ctx.fill();
        };
        this.update = function () {
            if (this.r > 0 ) {
                let s = this.r - 1;
                this.r = (s <  0) ? 1 : s;
                this.x += generateRandomNumber(-2,2);
                this.y += generateRandomNumber(-2,2);

            }
        };
    }
}

function drawCircles() {
    for (let i = 0; i < balls.length; i++) {
        balls[i].update();
        balls[i].draw();
    }
}

function mouseMove(e) {
    mouse.x = e.offsetX;
    mouse.y = e.offsetY;
}
