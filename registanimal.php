<?php
include_once "conn.php";

// Start the session
session_start();

date_default_timezone_set('UTC');

$curr_year = date("Y");

//Get the data
$registerAnimalName = $_SESSION["registerAnimalName"];
$VAT = $_SESSION["registerVAT"];
$registerAnimalColour = $_POST["registerAnimalColour"];
$registerAnimalSpecies = $_POST["registerAnimalSpecies"];
$registerAnimalGender = $_POST["registerAnimalGender"];
$registerAnimalBirth = $_POST["registerAnimalBirth"];



$registerAnimalAge = $curr_year-$registerAnimalBirth;

$sql = "INSERT INTO animal (name, VAT, species_name, colour, gender, birth_year, age) VALUES (?,?,?,?,?,?,?);";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $registerAnimalName, PDO::PARAM_STR);
$stmt->bindParam(2, $VAT, PDO::PARAM_INT);
$stmt->bindParam(3, $registerAnimalSpecies, PDO::PARAM_STR);
$stmt->bindParam(4, $registerAnimalColour, PDO::PARAM_STR);
$stmt->bindParam(5, $registerAnimalGender, PDO::PARAM_STR);
$stmt->bindParam(6, $registerAnimalBirth, PDO::PARAM_INT);
$stmt->bindParam(7, $registerAnimalAge, PDO::PARAM_INT);
$stmt->execute();
    
    
if($stmt === FALSE){
    echo('ERROR animal was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
}else{
    echo('Animal registered in the database successfully.');
}
 echo'<form action="index.php">
      <input type="submit" name="Go back to homepage" value="Go back to homepage">
    ';
?>