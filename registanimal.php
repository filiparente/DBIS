<?php
include_once "conn.php";

if((!isset($_POST["registerAnimalColour"]) || empty($_POST["registerAnimalColour"])) || (!isset($_POST["registerAnimalSpecies"]) || empty($_POST["registerAnimalSpecies"])) || (!isset($_POST["registerAnimalGender"]) || empty($_POST["registerAnimalGender"]))|| (!isset($_POST["registerAnimalGender"]) || empty($_POST["registerAnimalGender"]))){
    echo('ERROR -  All fields are mandatory.');
    echo('<br>');
    echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
}else{

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
    try{
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

        echo('Animal registered in the database successfully.');
    }catch(PDOException $e){
        echo('ERROR animal was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
        echo('<br>');
    }
        
    echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
}
?>