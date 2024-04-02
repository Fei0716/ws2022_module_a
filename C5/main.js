document.addEventListener('DOMContentLoaded',function(){
    const input  = document.querySelector('#color-input');
    const error = document.querySelector('.error-result');
    const colorType = document.querySelector('.color-type');
    const hexColor = document.querySelector('.hex-color-value');
    const rgbColor = document.querySelector('.rgb-color-value');

    let hex = rgb = '';
    input.addEventListener('input', function(){
        var input = this.value;
        if(input === ''){
            error.classList.remove('hide');
        }else if(input[0] == '#'){
            //... is spread operator
            if(checkForHexError(...[...input])){
                error.classList.remove('hide');
            }else{
                error.classList.add('hide');
                hex = input;
                rgb = convertHexToRGB(...[...input]);
                colorType.innerHTML = 'HEX';
                hexColor.innerHTML = hex;
                rgbColor.innerHTML = rgb;
            }
        }else if(input.match(/^rgb/)){
            rgb = checkForRgbError(input);
            if(!rgb){
                error.classList.remove('hide');
            }else{
                error.classList.add('hide');
                colorType.innerHTML = 'RGB';
                hexColor.innerHTML = hex;
                rgbColor.innerHTML = rgb;
            }
        }
    }); 
                            //firstChar = # , hexValues are the subsequent values after #
    function checkForHexError(firstChar , ...hexValues){
        let pattern  = /[^a-fA-F\d]/g;//check for invalid hex values for color
        if(hexValues.length != 6 || pattern.test(hexValues.join(''))){
            return true;
        }
        return false;
    }

    function convertHexToRGB(firstChar , ...hexValues){
        let red = parseInt(hexValues[0] + hexValues[1], 16);
        let blue = parseInt(hexValues[2] + hexValues[3], 16);
        let green = parseInt(hexValues[4] + hexValues[5], 16);

        return `rgb(${red} , ${blue}, ${green})`;
    }
    function checkForRgbError(input){
        let rgb = input.replace(/[^\d,]/g , '');
        if(!rgb){
            return false;
        }else{
            let hexValues = '#';
            // check for every value for r,g,b
            let rgbValues = rgb.split(',');
            if(rgbValues.length == 3){
                let error = false;
                rgbValues.forEach(function(color){
                    var value = parseInt(color.trim());
                    if( value > 255 || value < 0 || isNaN(value)){
                        error = true;
                        return;
                    }else{
                        if(value.toString(16).length < 10){
                            hexValues+= value.toString(16).padStart(2,"0");
                        }else{
                            hexValues+= value.toString(16);
                        }
                    }
                });     
                if(error){
                    return '';
                }
                return hexValues;           
            }
            return '';
        }
    }

});