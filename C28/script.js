document.addEventListener("DOMContentLoaded", () => {
    const pals = ['000', '088', '00d', '438', '800', '888', '8cf', 'aa2', 'b82', 'c18', 'fbb', 'e00', 'fd0', 'feb', 'ddd', 'fff'];
    const squaresContainer = document.getElementsByClassName('squares')[0];
    const colorsContainer = document.getElementsByClassName('colors')[0];
    // load squares
    for(let i = 0; i < 256 ;i++){
        squaresContainer.innerHTML += `
            <div class="square"></div>
        `;
    }

    // load colors
    for(let i = 0; i < pals.length; i++){
        colorsContainer.innerHTML += `
            <div class="color" style="background-color:#${pals[i]}"> </div>
        `;
    }

    let selectedColor = "";
    const colors = document.getElementsByClassName('color');
    const squares = document.getElementsByClassName('square');

    for (let i = 0; i < colors.length; i++) {
        colors[i].addEventListener('click', function() {
            const previouslySelected = document.querySelector('.color.active');
            if (previouslySelected) {
                previouslySelected.classList.remove('active');
            }
            // add active
            this.classList.add('active');
            selectedColor = window.getComputedStyle(this).backgroundColor;
            // selectedColor = this.style.backgroundColor;
        });
    }

    
    for (let i = 0; i < squares.length; i++) {
        squares[i].addEventListener('click', function() {
            console.log(selectedColor);
            this.style.backgroundColor = `${selectedColor}`;
        });
    }
});