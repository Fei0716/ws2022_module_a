var strokeStyle = "#000000"; 
var lastX = lastY =  0;
var isDrawing = false;
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
document.addEventListener('DOMContentLoaded',function(){
    document.getElementById("canvas").addEventListener("resize",function(e){
        isDrawing = true;
        lastX = e.offsetX;
        lastY = e.offsetY;
    });
    document.getElementById("canvas").addEventListener("mousedown",function(e){
        isDrawing = true;
        lastX = e.offsetX;
        lastY = e.offsetY;
    });
    document.getElementById("canvas").addEventListener("mousemove",function(e){
        if(!isDrawing) return;
    
            let x = e.offsetX;
            let y = e.offsetY;
            context.beginPath();
            context.moveTo(lastX, lastY);
            context.lineTo(x, y);
            context.strokeStyle = strokeStyle;
            context.lineWidth = '3px';
            context.lineJoin = 'round';
            context.closePath();
            context.stroke();
            lastX = x;
            lastY = y;
    
    });
    document.getElementById("canvas").addEventListener("mouseup",function(e){
        isDrawing = false;
    });
    document.getElementById("black").addEventListener("click",() =>{
        strokeStyle = '#000000';
    });
    document.getElementById("red").addEventListener("click",() =>{
        strokeStyle = '#FF0000';
    });
    
    document.getElementById("yellow").addEventListener("click",() =>{
        strokeStyle = '#FFFF00';
    });
    
    document.getElementById("green").addEventListener("click",() =>{
        strokeStyle = '#008000';
    });
    
    document.getElementById("blue").addEventListener("click",() =>{
        strokeStyle = '#0000FF';
    });
    
    document.querySelector("#btn-jpg").addEventListener("click", function() {
        const dataURL = canvas.toDataURL(); 
        const link = document.createElement('a');
        link.href = dataURL;
        link.download = "drawing.jpg";
        link.click(); 
    });
    document.querySelector("#btn-png").addEventListener("click", () =>{
        const dataURL = canvas.toDataURL(); 
        const link = document.createElement('a');
        link.href = dataURL;
        link.download = "drawing.png";
        link.click(); 
    });

});