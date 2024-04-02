document.addEventListener("DOMContentLoaded",function(){
    const img = 'firework_sprites(edited).png';
    const body = document.getElementsByTagName('body')[0];
    function generateFirework(){
        let positionX = Math.floor(Math.random() * (body.clientWidth-150));
        let positionY = Math.floor(Math.random() * (body.clientHeight-150));

        // there would be 6 different firework patterns for one explosion
        for(let i = 1; i <= 6; i++){
            let firework = document.createElement('div');
            if(i == 1){
                firework.style.cssText = `top: ${positionY}px; left: ${positionX}px ;filter: hue-rotate(${Math.floor(Math.random()*361)}deg)`;
            }else{
                let randomX = Math.floor(Math.random() * 101) - 50; // Random value between -50 and 50
                let randomY = Math.floor(Math.random() * 101) - 50; // Random value between -50 and 50

                let newX = positionX + randomX;
                let newY = positionY + randomY;
                firework.style.cssText = `top: ${newY}px; left: ${newX}px;filter: hue-rotate(${Math.floor(Math.random()*361)}deg)`;
            }
            firework.style.animationDelay = `${i/4}s`;
            firework.classList.add('firework');
            firework.classList.add(`firework-${i}`);
            body.appendChild(firework);            
        }
    }
    generateFirework();
    setInterval(()=>{
        generateFirework();
    },20);
});