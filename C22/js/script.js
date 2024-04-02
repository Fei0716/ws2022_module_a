document.addEventListener('DOMContentLoaded', function(){
    const cards = document.querySelectorAll('.card');
    const groups = document.querySelectorAll('.group');

    cards.forEach(function(card){
        card.addEventListener('mousedown' , dragStart);
    });

    let startX, startY;
    let lastLeft ,lastTop;
    let isDragging = false;

    function dragStart(event) {
        lastLeft = this.style.left||0;
        lastTop = this.style.top||0;

        this.style.transform = "rotate(5deg)";
        this.style.zIndex = "2";
        isDragging = true;
        startX = event.pageX;
        startY = event.pageY;
        this.addEventListener('mousemove' , dragMove);
        this.addEventListener('mouseup' , dragStop);
    }

    function dragMove(event) {
        if(!isDragging) {
            return;
        }
        // move the card
        let offsetX = event.pageX - startX;
        let offsetY = event.pageY - startY;
        let currentLeft = parseInt(lastLeft, 10);
        let currentTop = parseInt(lastTop, 10);
        this.style.left = (currentLeft + offsetX) + 'px';
        this.style.top = (currentTop + offsetY) + 'px';
        console.log(this.style.left);
        let card = this;
        let cardRect = this.getBoundingClientRect();
        // check whether the card is entering another group
        groups.forEach(function(group) {
            const rect = group.getBoundingClientRect();
            if (
               cardRect.left>= rect.left &&
               cardRect.right <= rect.right &&
               cardRect.bottom >= rect.top
            ) {
                // Check if the group is empty
                let groupIsEmpty = group.querySelectorAll('.card').length === 0;

                if(!groupIsEmpty) {
                    // Card is inside this group
                    group.querySelectorAll('.card').forEach(function(item , index){
                        let itemRect = item.getBoundingClientRect();
                        if(item != card){
                            if(cardRect.top <= itemRect.bottom / 2  && cardRect.bottom >= itemRect.top){
                                // slide to top of the item
                                item.parentNode.insertBefore(card, item.previousSibling);
                                reset(card);
                                return;
                            }else if(cardRect.top >= itemRect.bottom / 2 && cardRect.top <= itemRect.bottom){
                                // slide to the bottom of the item
                                item.parentNode.insertBefore(card, item.nextSibling);
                                reset(card);
                                return;
                            }                               
                        }

                    });                    
                }else{
                    group.querySelector('.group-sortable').appendChild(card);
                    reset(card);
                    return;
                }
            }
        });
    }

    function dragStop(card) {
        isDragging = false;
        startX =  startY = 0;


        this.style.transform = "rotate(0)";
        this.style.zIndex = "1";

        this.removeEventListener('mousemove' , dragMove);
        this.removeEventListener('mouseup' , dragStop);
    }
    function reset(card){
        card.style.left = 0 + 'px';
        card.style.top =  0 + 'px';
        lastLeft = 0;
        lastTop = 0;
        startX = event.pageX;
        startY = event.pageY;
        card.removeEventListener('mousemove' , dragMove);
        isDragging = false;
        startX =  startY = 0;


        card.style.transform = "rotate(0)";
        card.style.zIndex = "1";
    }
});
