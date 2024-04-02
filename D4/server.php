<?php
    $isAjaxRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

   if ($isAjaxRequest) {
        $data = json_decode(file_get_contents('data.json'), true);

        $start =isset($_GET['start']) ? intval($_GET['start']) : 0;

        $response = array_slice($data , $start , 10);

        echo json_encode($response ,JSON_PRETTY_PRINT);
        
        exit;
    }
?>
