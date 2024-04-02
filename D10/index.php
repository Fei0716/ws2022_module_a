<?php
	if(isset($_GET['string'])){
        $string = trim($_GET['string']);
        $filteredString = preg_replace('/\d/', '', $string);
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
        <label for="string">Write Anything</label>
        <input name="string" id="string">
        <button type="submit">Submit</button>        
    </form>

</body>
</html>