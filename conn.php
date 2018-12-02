<?php
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "part2";

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
    echo("<p>Error: ");
    echo($exception->getMessage());
    echo("</p>");
    exit();
}


// Create connection
//$conn = new mysqli($servername, $user, $pass, $host);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 