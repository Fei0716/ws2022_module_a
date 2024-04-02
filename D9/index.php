<?php
	if(isset($_GET['numbers'])){
        $numbers = explode("\r\n",trim($_GET['numbers']));
        $evenNumbers = [];
        foreach($numbers as $number){
            if(is_int($number / 2) ){
                array_push($evenNumbers,trim($number));
            }
        }
        sort($evenNumbers);
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="get">
        <textarea name="numbers" id="" cols="30" rows="10"><?php
                if(isset($evenNumbers)){
                    echo implode("\n",$evenNumbers);
                }
            ?></textarea>
        <button type="submit">Submit</button>        
    </form>

</body>
</html>