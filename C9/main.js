document.addEventListener("DOMContentLoaded",function(){
    var clock = {
        canvas: document.getElementById("canvas"),
        ctx: canvas.getContext("2d"),
        x: 20,
        y: 20,                
        lastHour: new Date().getHours(),
        lastMinute: new Date().getMinutes(),
        lastSecond: new Date().getSeconds(),
        effectParticles: [],
        start: function(){
            setInterval(()=>{
                this.hour =  new Date().getHours(),
                this.minute= new Date().getMinutes(),
                this.second= new Date().getSeconds(), 
                updateTimer();
            },20);
        }
    }
    clock.start();

    function updateTimer(){
        clock.ctx.clearRect(0, 0, clock.canvas.width, clock.canvas.height);
        for(particle of clock.effectParticles){
            particle.update();
            particle.draw();
        }
        clock.x =clock.y = 20;
        // draw hour
        drawTime("time", clock.hour , "hour");
        // draw the divider
        drawTime("divider", 0);
        // draw minute
        drawTime("time", clock.minute , "minute");
        // draw the divider
        drawTime("divider", 0);
        drawTime("time", clock.second , "second");

    }
    function checkTime(number , specification) {
        let changed = false;
        switch(specification){
            case "second":
                if(clock.lastSecond != number){
                    changed = true;
                    clock.lastSecond = number;
                }
                break;
            case "minute":
                if(clock.lastMinute != number){
                    changed = true;
                    clock.lastMinute = number;
                }
                break;
            case "hour":
                if(clock.lastHour != number){
                    changed = true;
                    clock.lastHour = number;
                }
                break;
            default: break;
        }
        return changed;
    }
    function drawTime(type,number ,specification){
        let time = number.toString().padStart(2,'0');
        let particleX;
        let hasChanged = checkTime(number, specification);
        if(type == "time"){
            let counter = 0;
            // loops through those two digits
            while(counter < 2){
                for(let i=0; i< 10 ;i++){
                    particleX = clock.x;
                    for(let j = 0; j < 7 ;j++){
                        if(NUMBERS[time[counter]][i][j] == 1){
                            clock.ctx.beginPath();
                            clock.ctx.arc(particleX,clock.y,4,0,2 *Math.PI);
                            clock.ctx.fillStyle = "#000000";
                            clock.ctx.fill();
                            if(hasChanged){
                                let temp = clock.lastSecond - 1;
                                switch(specification){
                                    case "second":
                                        if(time[counter] != temp.toString().padStart(2, '0')[counter]){
                                            generateEffect(particleX,clock.y,4);
                                        }
                                    break;
                                    case "minute":
                                        if(time[counter] != temp.toString().padStart(2, '0')[counter]){
                                            generateEffect(particleX,clock.y,4);
                                        }
                                    break;
                                    case "hour":
                                        if(time[counter] != temp.toString().padStart(2, '0')[counter]){
                                            generateEffect(particleX,clock.y,4);
                                        }
                                    break;
                                }
                            }
                        }

                        particleX  += 10;
                    } 
                    clock.y += 10;
                }  
                clock.y = 20;          
                clock.x += 80; 
                counter++;    

            } 
        }else{
            // for divider
            for(let i=0; i< 10 ;i++){
                particleX = clock.x;
                for(let j = 0; j < 7 ;j++){
                    if(NUMBERS[10][i][j] == 1){
                        clock.ctx.beginPath();
                        clock.ctx.arc(particleX,clock.y,4,0,2 *Math.PI);
                        clock.ctx.fillStyle = "#000000";
                        clock.ctx.fill();
                    }
                    particleX  += 10;
                } 
                clock.y += 10;
            }  
            clock.y = 20;          
            clock.x += 80; 
        }

    }
    function generateRandomNumber(min, max){
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    function generateEffect(x,y,r){
        color = `rgb(${generateRandomNumber(0,255)} ,${generateRandomNumber(0,255)}, ${generateRandomNumber(0,255)}  )`;
        let particle = new colorfulParticle(color, x, y, r);
        clock.effectParticles.push(particle);
    }
    function colorfulParticle(color, x, y, r){
        this.initialX = x;
        this.initialY = y;
        this.x = x;
        this.y = y;
        this.r = r;
        this.color = color;
        this.direction = -1;
        this.draw = function(){

            clock.ctx.beginPath();
            clock.ctx.fillStyle = this.color;
            clock.ctx.arc(this.x , this.y, this.r, 0 , 2 * Math.PI);
            clock.ctx.fill();

        }
        this.update= function(){
            this.y += this.direction * 2; 

            if (this.y <= this.initialY - 20) { 
                this.direction = 1; 
            }
            this.direction *= 1.2;
            this.x += this.direction* generateRandomNumber(-2, 2);

        }
    }
});