<?php
session_start();
/**
 * define the number of ../ to get to the root folder
 */
define('ROOT_LEVEL', '../');

/**
 * require the general functions file
 */
require(ROOT_LEVEL . 'include/functions.php');

/*
 * look up the user
 */

$credentials = [$_POST['username'], hash('sha256',$_POST['password'])];
$pdo = dbConnect();
$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username`= ? AND `password`= ?");
$stmt->execute($credentials);
$user = $stmt->fetch();

/*
 * if no user is found, redirect to the login page with an error,
 * otherwise, save the info in a cookie
 */

if (!$user){
    displayError($_POST['username']);
    header('Location:' . ROOT_LEVEL . 'login.php');
    exit;
} else {

    // setcookie('logged_in', serialize(['id' => $user['id'], 'username' => $user['username']]), 0, '/');

    $sessionToken = generateToken($user['username']);
    setcookie('logged_in', $sessionToken, time() + (86400 * 30), '/');
    header('Location:' . ROOT_LEVEL . 'index.php');
    storeSessionToken($sessionToken,$user['id']);
    exit;
}

