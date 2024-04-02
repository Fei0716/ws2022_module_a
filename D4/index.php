<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        #data-display{
            height: 500px;
            width: 800px;
            overflow-y: auto;
            margin: 0 auto;
        }
        .data{
            height: 100px;
            width: 100%;
            background-color: light-grey;
            border-bottom: 2px solid black;
        }
    </style>
</head>
<body>
    <div id="data-display">

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var dataDisplayDiv = document.getElementById('data-display');
            function loadData(start){
                console.log(start);
                let ajax = new XMLHttpRequest();                
                ajax.onload = () =>{
                    if(ajax.status == 200) {

                        var data = JSON.parse(ajax.responseText);
                        displayData(data);
                    }else{
                        console.log('Failed to load data' + ajax.status);
                    }
                }
                ajax.open('GET','server.php?start='+start ,true);
                ajax.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                ajax.send();
            }

            loadData(0);

            function displayData(data){
                data.forEach(function(x){
                    dataDisplayDiv.innerHTML +=
                    `
                        <div class="data">
                            ${x.first_name} ${x.last_name}, ${x.email}, ${x.country}, ${x.city}, ${x.phone}
                        </div>
                    `;
                });
            }   
            let startIndex = 0;
            dataDisplayDiv.addEventListener('scroll', function(e){
                if(this.scrollTop + this.clientHeight >= this.scrollHeight){
                    loadData(++startIndex);
                }
            });
        });
    </script>
</body>
</html>