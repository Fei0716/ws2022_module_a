// Input your code
document.addEventListener('DOMContentLoaded', function(){
    const circleLeft = document.getElementsByClassName('circle-left')[0]; 
    const circleRight = document.getElementsByClassName('circle-right')[0];
    const bar = document.getElementsByClassName('bar')[0];

    let left = 40; 
    let width = 20;
    let min = 400;
    let max = 600;

    let lastX1 = 0;
    let isSliding1 = false;
    // circleRight

    circleRight.addEventListener('mousedown', function(e){
        isSliding1 = true;
        lastX1 = e.pageX;
        this.addEventListener('mousemove', slide1);
        document.addEventListener('mouseup', stopSlide1);
    });
    function slide1(e){
        if(!isSliding1){
            return;
        }
        // slideRight
        if(e.pageX > lastX1){
            if(width + left < 100){
                width += 5;
                lastX1 = e.pageX;                
            }

        }else if(e.pageX < lastX1){
            if(width> 5){
                width -= 5
                lastX1 = e.pageX;                
            }
        }

        bar.style.width = width + '%';
        max = (width / 5 * 50) + min;
        document.querySelector('.cost-right > span').innerHTML = max;
    }
    function stopSlide1() {
        isSliding1 = false;
        document.removeEventListener('mousemove', slide1);
        document.removeEventListener('mouseup', stopSlide1);
    }

    // circleLeft
    let isSliding2 = false;
    let lastX2 = 0;
    circleLeft.addEventListener('mousedown', function(e){
        isSliding2 = true;
        lastX2 = e.pageX;
        this.addEventListener('mousemove', slide2);
        document.addEventListener('mouseup', stopSlide2);
    });
    function slide2(e){
        if(!isSliding2){
            return;
        }
        // slideRight
        if(e.pageX > lastX2){
            if(width > 5){
                left += 5;
                width -= 5;
                lastX2 = e.pageX;                
            }

        }else if(e.pageX < lastX2){
            if(left > 0){
                width += 5
                left -= 5;
                lastX2 = e.pageX;                
            }
        }
        bar.style.width = width + '%';
        bar.style.left = left + '%';
        min = (left / 5 * 50) ;
        document.querySelector('.cost-left > span').innerHTML = min;
    }
    function stopSlide2(){
        isSliding2 = false;
        document.removeEventListener('mousemove', slide2);
        document.removeEventListener('mouseup', stopSlide2);
    }
});
