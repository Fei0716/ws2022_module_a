<?php

/**
 * This function checks to see if a user is logged in and will
 * redirect to the login page if required.
 */
function checkLogin(){
    if (!$_COOKIE['logged_in']){
        header('Location:' . ROOT_LEVEL . 'login.php');
        exit;
    }
}

/**
 * This method attempts to connect to the database and returns a PDO
 * connection object.
 *
 * @return PDO
 */
function dbConnect(){
    try{
        $pdo = new PDO(
            'mysql:host=localhost:3301;dbname=ws2022_d15;',
            'root', '');
        return $pdo;
    } catch (Exception $e){
        die($e->getMessage());
    }
}

/**
 * This function returns an array of information about the user who
 * is logged in.
 *
 * @return mixed
 */
function userInfo(){
    $data = $_COOKIE['logged_in'];
    $pdo = dbConnect();
    $stmt = $pdo->prepare("SELECT username FROM users WHERE session_token = ?");
    $stmt->bindParam(1,$data);
    $stmt->execute();
    $user = $stmt->fetch();
    return $user;
}
// to create a user
function insertUser(){
    $pdo = dbConnect();
    $stmt = $pdo->prepare("INSERT INTO users(username, password, login_attempts, session_token) VALUES(?,?,?,?)");
    // Define an array of values
    $values = ['user1', hash('sha256', 'abcd1234'), 0, null];

    // Execute the statement with the array of values
    $stmt->execute($values);
}
function displayError($username){
    $credentials = [$username];
    $pdo = dbConnect();
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username`= ? ");
    $stmt->execute($credentials);
    $user = $stmt->fetch();


    if($user){
        // if password is wrong
        $attempts = intval($user['login_attempts']) + 1;
        if($attempts < 3){
            $attemptLeft = 2 - $user['login_attempts'];
            updateLoginAttempt($user['username'] ,$attempts);
            $_SESSION['error'] = 'Invalid login credentials(You have '.$attemptLeft.' attempt left)';
    
        }else{
            $_SESSION['ban-error'] = 'You have attempted 3 times and failed(Please contact the administrator)';
        }
    }else{
        $_SESSION['error'] = "Invalid credentials";

    }
}
function updateLoginAttempt($username ,$login_attempts){
    $pdo = dbConnect();
    $stmt = $pdo->prepare("UPDATE users SET login_attempts = ? WHERE username = ?");
    // Define an array of values
    $values = [$login_attempts,$username];


    // Execute the statement with the array of values
    $stmt->execute($values);
}
function generateToken($username){
    return hash('sha256',$username);
}
function storeSessionToken($token,$userid){
    $pdo = dbConnect();
    $stmt = $pdo->prepare("UPDATE users SET session_token = ?, login_attempts = 0 WHERE id = ?");
    // Define an array of values
    $values = [$token,$userid];


    // Execute the statement with the array of values
    $stmt->execute($values);
}
function clearSessionToken($token){
    $pdo = dbConnect();
    $stmt = $pdo->prepare("UPDATE users SET session_token = NULL WHERE session_token = ?");
    // Define an array of values
    $values = [$token];
    // Execute the statement with the array of values
    $stmt->execute($values);
}