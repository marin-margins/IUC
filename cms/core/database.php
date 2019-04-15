<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'iuc_database';


try{
    $conn = new mysqli('localhost','username','password','database');
} catch(PDOException $e){
    die( "Connection failed: " . $e->getMessage());
}