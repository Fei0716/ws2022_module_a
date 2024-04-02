<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_SERVER['CONTENT_TYPE'] == 'application/json'){
            $currentTime = date('H-i-s');
            $folder = 'output';
            if(!file_exists($folder)){
                mkdir($folder, 0777, true);
            }
            $filename = $folder.'/'.$currentTime.'-request.txt';
            $jsonPayload = file_get_contents('php://input');

            file_put_contents($filename,$jsonPayload);

            var_dump($jsonPayload);
        }else{
            echo "Request does not match this: Content-Type: application/json";
        }
    }else{
        echo 'Only supports POST request';
    }

?>