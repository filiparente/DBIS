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
    $stmt->bindParam(1, $ownerName, PDO::PARAM_STR);
    $stmt->execute();
    
    foreach ($stmt as $row){
        $ownerVAT = $row["VAT"];
    }
    
    // INSERT CONSULT FIRST
    
    $sql = "INSERT INTO consult (name,VAT_owner, date_timestamp,s,o,a,p,VAT_client,VAT_vet,weight) values (?,?,?,?,?,?,?,?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $animalName, PDO::PARAM_STR);
    $stmt->bindParam(2, $ownerVAT, PDO::PARAM_INT);
    $stmt->bindParam(3, $date, PDO::PARAM_STR);
    $stmt->bindParam(4, $_POST["S"], PDO::PARAM_STR);
    $stmt->bindParam(5, $_POST["O"], PDO::PARAM_STR);
    $stmt->bindParam(6, $_POST["A"], PDO::PARAM_STR);
    $stmt->bindParam(7, $_POST["P"], PDO::PARAM_STR);
    $stmt->bindParam(8, $clientVAT, PDO::PARAM_INT);
    $stmt->bindParam(9, $vetVAT, PDO::PARAM_INT);
    $stmt->bindParam(10, $_POST["weight"], PDO::PARAM_STR);
    $stmt->execute();
    
    if($stmt === FALSE){
        echo('ERROR Consult was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
        echo('<br>');
    }else{
        echo('Consult registered in the database successfully!');
        echo('<br>');
    }

    // INSERT CONSULT DIAGNOSIS AFTER
    

    if(isset($_POST["DiagnosticCodes"]) && !empty($_POST["DiagnosticCodes"])){
        $diagnosis_str = $_POST["DiagnosticCodes"];
        $diagnosis_array = explode("+",$diagnosis_str);

        try{
            // Begin transaction
            $conn->beginTransaction();
            $norollback = TRUE;

            foreach ($diagnosis_array as $diagnosis){

                //Insert each diagnosis into consult_diagnosis
                $sql = "INSERT INTO consult_diagnosis (code, name, VAT_owner, date_timestamp) values (?,?,?,?);";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $diagnosis, PDO::PARAM_INT);
                $stmt->bindParam(2, $animalName, PDO::PARAM_STR);
                $stmt->bindParam(3, $ownerVAT, PDO::PARAM_INT);
                $stmt->bindParam(4, $date, PDO::PARAM_STR);
                $stmt->execute();

                if($stmt === FALSE){
                    echo('ERROR Consult diagnosis was not registered.');
                    echo('<br>');
                    $conn->rollBack();
                    $norollback = FALSE;
                }
            
            }
            if($norollback === TRUE){
                $conn->commit();
                echo('Consult diagnosis "'.$diagnosis_str.'" registered in the database successfully!');
                echo('<br>');
            }
        }
        catch( Exception $e ) {
            # Check if statement is still open and close it
            if($stmt){
                $stmt->close();
            }
    
            # Create your error response
            echo($e->getMessage());
        }
    }
        
    //header("Location: getAnimal.php");
    echo '<form action="index.php">
      <input type="submit" name="Go back" value="Go back to homepage">
    ';
    