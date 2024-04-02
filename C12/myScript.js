document.addEventListener("DOMContentLoaded",function(){
    var links = document.querySelectorAll("header a");



    links.forEach(function(link){
        link.addEventListener('click' , (e) => {
            e.preventDefault();
            var href = link.href;
            loadContent(href);

            history.pushState({path: href}, "" , href);

        });
    });

        // Handle back/forward navigation
        window.onpopstate = function (event) {
            console.log(event.state);
            if(event.state && event.state.path ){
                loadContent(event.state.path);
            }
        };


        function loadContent(href) {
            console.log(href);
            // fetch using ajax
            fetch(href)
            .then(response => response.text())
            .then(
                html => {
                    var newDoc = new DOMParser().parseFromString(html ,'text/html');
                    document.title = newDoc.title;

                    var mainContent = document.querySelector('main');
                    mainContent.innerHTML = newDoc.querySelector('main').innerHTML;

                }
            )
            .catch(error => {
                console.log(error);
            });
        }
});