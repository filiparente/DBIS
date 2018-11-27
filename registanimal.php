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

$sql="INSERT INTO animal (name, VAT, species_name, colour, gender, birth_year, age) VALUES (?,?,?,?,?,?,?);";
$stmt=$conn->prepare($sql);
$stmt->bind_param("sdsssdd",$registerAnimalName,$VAT,$registerAnimalSpecies,$registerAnimalColour,$registerAnimalGender,$registerAnimalBirth,$registerAnimalAge);
$stmt->execute();
$stmt->store_result();

if ($stmt == TRUE){
    echo('Animal registered successfully.');
}else{
    echo('Error, animal was not registered.');
}
echo '<form action="index.php">
      <input type="submit" name="Go back to homepage" value="Go back to homepage">
    ';
?>