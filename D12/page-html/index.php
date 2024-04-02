<?php
    $fileDirectory = __DIR__.'/../videos.json';
    $data = json_decode(file_get_contents($fileDirectory), true);
?>      


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Video List Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>

<div class="container">

    <h1 class="h2 py-5 text-center">Video List</h1>

    <div class="row">
        <?php foreach($data as $x):?>
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header py-3">
                    <span class="h6 fw-bold"><?=$x['title']?></span>
                </div>
                <!-- <img 
                    src="placeholder.gif" 
                    alt="preview media here" 
                    class="card-img rounded-0" 
                    data-animated-src="../previews/<?=$x['preview']?>.gif"
                > -->
                <video class="card-img rounded-0" muted>
                    <source  src="../previews/<?=$x['preview']?>.mp4">
                </video>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="icon icon-clock me-2"></i>
                        <span class="me-3"><?=$x['duration']?></span>
                        <i class="icon icon-eye me-2"></i>
                        <span><?=$x['views']?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>

    </div>

    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.card-img').hover(
                function(){
                        this.play();
                },
                function(){
                        this.pause();
                }
            );
        });        
    </script>

</div>

</body>
</html>