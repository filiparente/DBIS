<?php
    include_once "conn.php";

    if((!isset($_POST["weight"]) || empty($_POST["weight"]) || (!isset($_POST["veterinaryVAT"]) || empty($_POST["veterinaryVAT"])))){
        echo('ERROR -  Required fields not filled in.');
        echo('<br>');
        echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
    }else{
        // Start session to get variables from homepage
        session_start();

        $animalName = $_GET["animalName"];
        $ownerName = $_GET["ownerName"];
        $clientVAT = $_SESSION["clientVAT"];
        $vetVAT = $_POST["veterinaryVAT"];

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
        if(!isset($_POST["S"]) || empty($_POST["S"])){
            $s = "default";
        }else{
            $s = $_POST["S"];
        }

        if(!isset($_POST["O"]) || empty($_POST["O"])){
            $o = "default";
        }else{
            $o = $_POST["O"];
        }

        if(!isset($_POST["A"]) || empty($_POST["A"])){
            $a = "default";
        }else{
            $a = $_POST["A"];
        }

        if(!isset($_POST["P"]) || empty($_POST["P"])){
            $p = "default";
        }else{
            $p = $_POST["P"];
        }

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

            
            // Begin transaction
            $conn->beginTransaction();
            $norollback = TRUE;

            foreach ($diagnosis_array as $diagnosis){

                //Insert each diagnosis into consult_diagnosis
                try{
                    $sql = "INSERT INTO consult_diagnosis (code, name, VAT_owner, date_timestamp) values (?,?,?,?);";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $diagnosis, PDO::PARAM_INT);
                    $stmt->bindParam(2, $animalName, PDO::PARAM_STR);
                    $stmt->bindParam(3, $ownerVAT, PDO::PARAM_INT);
                    $stmt->bindParam(4, $date, PDO::PARAM_STR);
                    $stmt->execute();
                }
                catch(PDOException $e)
                {
                    echo("ERROR Consult diagnosis was not registered.");
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
            
        //header("Location: getAnimal.php");
        echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
    }
        