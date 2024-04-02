<?php
    require('random.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            padding: 12px;
        }
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        .bar{
            border: 2px solid #000;
            margin-left: 20px;
            margin-right: 20px;
            max-height: 500px;
        }
        .bar-chart{
            margin-left: 30px;
            width: fit-content;
            height: 500px;
            border-bottom: 2px solid #000;
            border-left: 2px solid #000;
            position: relative;
        }
        .bars-container{
            display: flex;
            height: 100%;
        }
        .bar-container{
            width: 100px;
            margin-top: auto;
        }
        .bar-x-container{
            position:absolute;
            top: 500px;
            display: flex;
        }
        .bar-x{
            text-align: center;
            padding-top: 20px;
            width: 100px;
        }
        .bar-y-container{
            display: flex;
            flex-direction: column-reverse;
            position: absolute;
        }
        .bar-y{
            height: 100px;
        }
    </style>
</head>
<body>
<div class="bar-y-container">
            <?php
                    for($i = 0;$i <= 500; $i+=100){
                        echo"<div class='bar-y'>".$i."</div>";
                    }
            ?>  
        </div>
    <div class="bar-chart">

        <div class="bars-container">
            
            <?php
                foreach($data as $x){
                    echo"<div class='bar-container'>";
                        echo"<div class='bar' style='height:".$x['value']."px;background-color:rgb(".mt_rand(0,255).",".mt_rand(0,255).",".mt_rand(0,255).")';></div>";
                    echo "</div>";
                }
            ?>
        </div>
        <div class="bar-x-container">
            <?php
                    foreach($data as $x){
                        echo"<div class='bar-container'>";
                            echo"<div class='bar-x'>".$x['name']."</div>";
                        echo "</div>";
                    }
                ?>  
        </div>
    </div>
</body>
</html>