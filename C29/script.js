document.addEventListener("DOMContentLoaded", () => {
    document.addEventListener('click' ,function(e){
        const modal = document.getElementsByClassName("modal")[0];
        const body = document.getElementsByTagName("body")[0];

        if(e.target.matches('#open')){
            modal.classList.add('show');
            body.classList.add('overflow-hidden');

        }else{
            modal.classList.remove('show');
            body.classList.remove('overflow-hidden');
        }
    });
});