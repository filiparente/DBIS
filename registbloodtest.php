<?php
    include_once "conn.php";

    try{
        // Begin transaction
        $conn->begin_transaction();

        // Get variables
        $animalName = $_GET["animalName"];
        $clientName = $_GET["clientName"];
        $ownerName = $_GET["ownerName"];
        $VAT_owner = $_GET["VAT_owner"];
        $VAT_vet = $_GET["VAT_vet"];
        $VAT_client = $_GET["VAT_client"];
        $date = $_GET["date"];

        $indicators_array = ["bloodpH", "hemoglobin","cholesterol", "totalProtein", "creatinine", "BUN", "glucose"];

        // Flags
        $norollback = TRUE;
        $flag_indicators = FALSE;

        // Check num of the last procedure and increment it
        $sql = "select max(num) as max_procedure from procedures where name=? and VAT_owner=? and date_timestamp=?;";
        $stmt = $conn->prepare($sql);
        
        if($stmt === FALSE){
            echo('ERROR couldnt access procedures num');
            echo('<br>');
        }else{
            $stmt->bind_param("sds", $animalName, $VAT_owner, $date);
            $result = $stmt->execute();
            $result = $stmt->get_result();

            if($result === FALSE){
                echo('ERROR couldnt access procedures num. Execute() failed: ' . htmlspecialchars($result->error));
                echo('<br>');
                $conn->rollback();
                $norollback = FALSE;
            }else{
                if($result->num_rows == 0){
                    $num = 1;
                }else{
                    $row = $result->fetch_assoc();
                    $num = $row["max_procedure"]+1;
                }
            }

        }
        
        if(isset($_POST["VAT_assist"])){
            $VAT_assist = $_POST["VAT_assist"];
            
            // FIRST insert into procedures
            $sql = "INSERT INTO procedures(name, VAT_owner, date_timestamp, num, description) values (?,?,?,?,'blood test');";
            $stmt = $conn->prepare($sql);

            if($stmt === FALSE){
                echo('ERROR procedure was not registered.');
                echo('<br>');
                $conn->rollback();
                $norollback = FALSE;
            }else{
                $stmt->bind_param("sdsd", $animalName, $VAT_owner, $date, $num);
                $result = $stmt->execute();
                if($result === FALSE){
                    echo('ERROR test_procedure was not registered. Execute() failed: ' . htmlspecialchars($result->error));
                    echo('<br>');
                    $conn->rollback();
                    $norollback = FALSE;
                }
            }

            // SECOND insert into performed
            $sql = "INSERT INTO performed(name, VAT_owner, date_timestamp, num, VAT_assistant) values (?,?,?,?,?);";
            $stmt = $conn->prepare($sql);

            if($stmt === FALSE){
                echo('ERROR performed was not registered.');
                echo('<br>');
                $conn->rollback();
                $norollback = FALSE;
            }else{
                $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $VAT_assist);
                $result = $stmt->execute();
                if($result === FALSE){
                    echo('ERROR performed was not registered. Execute() failed: ' . htmlspecialchars($result->error));
                    echo('<br>');
                    $conn->rollback();
                    $norollback = FALSE;
                }
            }

            // THIRD insert into test_procedure (only for blood tests)
            $type = "blood"; //hardcoded, since registry is for blood tests only

            $sql = "INSERT INTO test_procedure(name, VAT_owner, date_timestamp, num, type) values (?,?,?,?,?);";
            $stmt = $conn->prepare($sql);

            if($stmt === FALSE){
                echo('ERROR test_procedure was not registered.');
                echo('<br>');
                $conn->rollback();
                $norollback = FALSE;
            }else{
                $stmt->bind_param("sdsds", $animalName, $VAT_owner, $date, $num, $type);
                $result = $stmt->execute();
                if($result === FALSE){
                    echo('ERROR test_procedure was not registered. Execute() failed: ' . htmlspecialchars($result->error));
                    echo('<br>');
                    $conn->rollback();
                    $norollback = FALSE;
                }
            }

            //FINALLY insert into produced_indicators the indicators filled by the doctor in the form
            foreach ($indicators_array as $indicator_name){
                if(isset($_POST[$indicator_name]) && !empty($_POST[$indicator_name])){
                    list($norollback, $flag_indicators) = register_indicator($norollback,$flag_indicators, $conn, $animalName, $VAT_owner, $date, $num, $indicator_name);
                }

            }

            // No indicator was produced for that particular test -> violates the constraint RI
            if ($flag_indicators === FALSE){
                echo('ERROR: Violation of the constraint "RI: all tests are required to produce at least one indicator"');
                $conn->rollback();
                $norollback = FALSE;
            }

            if($norollback === TRUE){
                $conn->commit();
                echo('Blood test registered in the database successfully!');
            }
                    
        }else{
            echo('Couldnt register the blood test as no VAT assistant was provided');
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

    echo '<form action="index.php">
        <input type="submit" name="Go back" value="Go back to homepage">
        ';

    function register_indicator($norollback,$flag_indicators, $conn, $animalName, $VAT_owner, $date, $num, $indicator_name) {
        $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,?,?);";
        $stmt = $conn->prepare($sql);
        
        if($stmt === FALSE){
            throw new Exception("ERROR '".$indicator_name."' indicator was not registered");
            echo('<br>');
            $conn->rollback();
            $norollback = FALSE;
        }else{
            $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $indicator_name, $_POST[$indicator_name]);
            $result = $stmt->execute();
            if($result === FALSE){
                echo("ERROR '".$indicator_name."' was not registered. Execute() failed: " . htmlspecialchars($result->error));
                echo('<br>');
                $conn->rollback();
                $norollback = FALSE;
            }else{
                $flag_indicators = TRUE;
            }
        }

        return array($norollback, $flag_indicators);
    }

?>