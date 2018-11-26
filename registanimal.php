<?php
include_once "conn.php";

date_default_timezone_set('UTC');

$curr_year = date("y");

//Get the data
$registerAnimalName = $_POST["registerAnimalName"];
$registerAnimalSpecies = $_POST["registerAnimalSpecies"];
$registerAnimalColour = $_POST["registerAnimalColour"];
$registerAnimalBirth = $_POST["registerAnimalBirth"];
$registerAnimalGender = $_POST["registerAnimalGender"];
$VAT = $_POST["VAT"];


$registerAnimalAge = $curr_year-$registerAnimalBirth;

$sql="INSERT INTO animal(name, VAT, species_name, colour, gender, birth_year, age) VALUES (?,?,?,?,?,?,?);";
$stmt=$conn->prepare($sql);
$stmt->bind_param("sdsssdd",$registerAnimalName,$VAT,$registerAnimalSpecies,$registerAnimalColour,$registerAnimalGender,$registerAnimalBirth,$registerAnimalAge);
$stmt->execute();
?>