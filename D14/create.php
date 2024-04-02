<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
<?php

    // Your code here
    include_once('test_php_doc.php');

    if(isset($_POST['title']) && isset($_POST['description']) ){
        $htd = new HTML_TO_DOC();
        $title = $_POST['title'];
        $description = $_POST['description'];
        $htmlContent = "<h1>$title</h1> 
            <p>$description</p>";

        $htd->createDoc($htmlContent, $title.'.doc' , true);        
    }

    exit;

?>
    
</body>
</html>