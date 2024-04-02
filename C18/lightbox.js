// lightbox.js
//self invoke function
(function() {
    const imgs = document.querySelectorAll('.lightbox > img');
    const lightbox = document.querySelector('.lightbox');
    const lightModal = document.createElement('div');  
    var showIndex =0;

    lightModal.classList.add('lightbox-modal');
    lightModal.innerHTML = `
        <button type="button" id="btn-prev">&lt;</button>
        <button type="button" id="btn-next">&gt;</button>
        <button type="button" id="btn-close">x</button>

        <img  id="lightbox-img">
        </img>

    `;
    lightbox.append(lightModal);

    imgs.forEach(function(img , i) {
        var src = img.src;
        img.addEventListener('click', function(){
            showIndex = i
            showImage(showIndex);
            showLightboxModal(src);
        });
    })


    document.addEventListener('click', function(e){
        if(e.target.matches('#btn-close') || !e.target.matches('#btn-next')&& !e.target.matches('#btn-prev')&&!e.target.matches('img')){
            lightModal.classList.remove('show');
        }
    });

    function showLightboxModal( src){
        document.getElementById('lightbox-img').src = src;
        lightModal.classList.add('show');
    }

  
    function showImage(index){
        var src = imgs[index].src;
        document.getElementById('lightbox-img').src = src;
    }
    document.getElementById('btn-next').addEventListener('click', function(e){
        showImage(showIndex + 1 > imgs.length -1 ? showIndex = 0 : showIndex += 1);
    });
    document.getElementById('btn-prev').addEventListener('click', function(e){
        showImage(showIndex - 1 < 0 ? showIndex = imgs.length - 1 : showIndex -= 1);
    });
})();
