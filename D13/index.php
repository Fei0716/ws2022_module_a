<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert code 64 to image</title>
</head>
<body>


    <form action="" method="POST">
        <textarea name="code" placeholder="CODE64"></textarea>
        <input type="submit" value="Convert">
    </form>

    <?php
        if(isset($_POST['code'])){
            $code64 = $_POST['code'];
            $img = base64_decode($code64);

            // create directory 
            $dir = 'img';
            if(!file_exists($dir)){
                mkdir($dir, 0777, true);
            }

            $filename = $dir .'/img'.uniqid().'.png';
            file_put_contents($filename, $img);
        }
    ?>

</body>
</html>