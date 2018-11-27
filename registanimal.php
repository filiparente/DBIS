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
$stmt->bind_param("sdsssdd", $registerAnimalName, $VAT, $registerAnimalSpecies, $registerAnimalColour, $registerAnimalGender, $registerAnimalBirth,$registerAnimalAge);
$result = $stmt->execute();
    
    
if($result === FALSE){
    echo('ERROR animal was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
}else{
    echo('Animal registered in the database successfully.');
}
 echo'<form action="index.php">
      <input type="submit" name="Go back to homepage" value="Go back to homepage">
    ';
?>