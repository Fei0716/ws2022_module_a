<?php
    if(isset($_GET['getMessage'])){
        $pdo = new PDO('mysql:host=localhost:3301;dbname=ws2022_d6' , 'root', '');
        $stmt = $pdo->prepare("SELECT * FROM message");
        $stmt->execute();
        $messages = $stmt->fetchAll();
        echo json_encode($messages , JSON_PRETTY_PRINT);
        exit;
    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $request = json_decode(file_get_contents('php://input') ,true);
        $data = [$request['message'] , $request['sender']];
        $pdo = new PDO('mysql:host=localhost:3301;dbname=ws2022_d6' , 'root', '');
        $stmt = $pdo->prepare("INSERT INTO message(content,username) VALUES(?,?)");
        $stmt->execute($data);
        exit;
    }

?>