<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // get the data
        $pdo = new PDO('mysql:host=localhost:3301;dbname=ws2022_d3' ,'root','');
        $stmt = $pdo->prepare("SELECT * FROM turns");
        $stmt->execute();
        $data = $stmt->fetchAll();

        header('Content-Type: application/json');
        echo json_encode($data,JSON_PRETTY_PRINT);
        exit;

    }else if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // store data
        $request = json_decode(file_get_contents('php://input'),true);
        $pdo = new PDO('mysql:host=localhost:3301;dbname=ws2022_d3' ,'root','');
        $data = [$request['player'] , $request['position']];
        $stmt = $pdo->prepare("INSERT INTO turns(player,position) VALUES(?,?)");
        $stmt->execute($data);

        echo json_encode(["message"  => "Insert successfully"]);
        exit;
    }else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $pdo = new PDO('mysql:host=localhost:3301;dbname=ws2022_d3' ,'root','');
        $stmt = $pdo->prepare("TRUNCATE TABLE turns");
        $stmt->execute();

        echo json_encode(["message"  => "Delete successfully"]);
        exit;
    }
?>
