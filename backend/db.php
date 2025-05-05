<?php

$host = 'localhost';
$db = 'loginsystem';
$user = 'root';
$password = '';


try{

    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    exit;

}
?>
