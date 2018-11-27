<?php
    include_once "conn.php";

    // Start session to get variables from homepage
    session_start();

    $animalName = $_GET["animalName"];
    $ownerName = $_GET["ownerName"];
    $clientVAT = $_SESSION["clientVAT"];
    $vetVAT = $_POST["veterinaryVAT"];
    

    //$sql = "select p1.VAT clientVAT, p2.VAT vetVAT, p3.VAT ownerVAT from person p1, person p2, person p3 where p1.VAT=? and p2.VAT=? and p3.name=?;";
    //$stmt = $conn->prepare($sql);
    //$stmt->bind_param("sss", $clientVAT, $_POST["veterinaryVAT"], $ownerName);
    //$stmt->execute();
    //$result = $stmt->get_result();

    //while($row = $result->fetch_assoc()){
    //   $clientVAT = $row["clientVAT"];
    //    $vetVAT = $row["vetVAT"];
    //    $ownerVAT = $row["ownerVAT"];
    //}

    // Get current date
    date_default_timezone_set('Europe/Lisbon');
    $date = date("Y-m-d H:i:s");

    //Get VAT from owner's name
    $sql = "select VAT from person where name=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ownerName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $ownerVAT = $row["VAT"];
    
    
    $sql = "INSERT INTO consult (name,VAT_owner, date_timestamp,s,o,a,p,VAT_client,VAT_vet,weight) values (?,?,?,?,?,?,?,?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsssssddd",$animalName, $ownerVAT, $date,$_POST["S"],$_POST["O"],$_POST["A"],$_POST["P"],$clientVAT,$vetVAT,$_POST["weight"]);
    $result = $stmt->execute();
    
    
    if($result === FALSE){
        echo('ERROR Consult was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
    }else{
        echo('Consult registered in the database successfully!');
    }

    //header("Location: getAnimal.php");
    echo '<form action="index.php">
      <input type="submit" name="Go back" value="Go back to homepage">
    ';
    