<?php
    $ajaxRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    if($ajaxRequest){
        $imagePath = __DIR__ . '/media/'.$_GET['image'];
        if(!file_exists($imagePath)){
            http_response_code(404);
            exit;
        }
        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        switch($extension){
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($imagePath);
                break;
            case 'png':
                $image = imagecreatefrompng($imagePath);
            default:break;
        }

        $watermarkText = "WorldSkills";
        $fontFile = __DIR__ . '/arialbd.ttf';
        $textColor = imagecolorallocate($image,255,255,255);
        $fontSize = 50;

        // to find the width and height of the text
        $bbox = imagettfbbox($fontSize, 0 ,$fontFile , $watermarkText);
        $textWidth = $bbox[2] - $bbox[0];
        $textHeight = $bbox[1] - $bbox[7];
        $x = imagesx($image) - $textWidth;
        $y = imagesy($image) - $textHeight;
        imagettftext($image,$fontSize,0,$x,$y, $textColor,$fontFile,$watermarkText);
        switch($extension){
            case 'jpg':
            case 'jpeg':
                header("Content-type: image/jpeg");
                ob_start();
                imagejpeg($image);
                $outputBuffer = ob_get_clean();
                $base64 = base64_encode($outputBuffer);
                echo '<img src="data:image/jpeg;base64,'.$base64.'" />';

                break;
            case 'png':
                header("Content-type: image/png");
                ob_start();
                imagepng($image);
                $outputBuffer = ob_get_clean();
                $base64 = base64_encode($outputBuffer);
                echo '<img src="data:image/png;base64,'.$base64.'" />';

                break;
            default:break;
        }


    }
?>