<?php

//FOR PHPMYADMIN
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "part2";


// Create connection
//$conn = new mysqli($servername, $user, $pass, $host);

//FOR SIGMA
$host = "db.tecnico.ulisboa.pt";
$user = "ist181324";
$pass = "xttm4017";
$dsn = "mysql:host=$host;dbname=$user";
try
{
    $conn = new PDO($dsn, $user, $pass);
}
catch(PDOException $exception)
{
    echo("Error: ");
    echo($exception->getMessage());
    echo("<br>");
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);