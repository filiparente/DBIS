<?php
    include_once "conn.php";

    $animalName = $_GET["animalName"];
    $clientName = $_GET["clientName"];
    $ownerName = $_GET["ownerName"];

    $VAT_owner = $_GET["VAT_owner"];
    $VAT_vet = $_GET["VAT_vet"];
    $VAT_client = $_GET["VAT_client"];

    $date = $_GET["date"];

    $flag_indicators = FALSE;

    $sql = "select max(num) as max_procedure from procedures where name=? and VAT_owner=? and date_timestamp=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sds", $animalName, $VAT_owner, $date);
    $result = $stmt->execute();

    if($result === FALSE){
        echo('ERROR couldnt access procedures num. Execute() failed: ' . htmlspecialchars($stmt->error));
        echo('<br>');
    }else{
        $result = $stmt->get_result();

        if($result->num_rows == 0){
            $num = 1; echo($num);
        }else{
            echo('entrei');
            echo($animalName);echo('<br>');
            echo($VAT_owner);echo('<br>');
            echo($date);echo('<br>');
            $row = $result->fetch_assoc();
            echo($row["max_procedure"]); echo('<br>');
            $num = $row["max_procedure"]+1;
            echo($num); echo('<br>');
        }
    }
    
    while(TRUE){
        if(isset($_POST["VAT_assist"])){
            $VAT_assist = $_POST["VAT_assist"];

            // Indicator_name must be in stored in table indicator in the database otherwise it will give error
            
            // FIRST insert into procedure

            //procedure(name,VAT_owner,date_timestamp,num,description)
            //name,VAT_owner,date_timestamp: FK(consult)
            //RI: procedure cannot simultaneously be radiography, tests, and/or surgical

            $sql = "INSERT INTO procedures(name, VAT_owner, date_timestamp, num, description) values (?,?,?,?,'no description for now');";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdsd", $animalName, $VAT_owner, $date, $num);
            $result = $stmt->execute();

            if($result === FALSE){
                echo('ERROR procedure was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                echo('<br>');
                break;
            }else{
                echo('procedure registered in the database successfully.');
                echo('<br>');
            }

            // SECOND insert into performed

            //performed(name,VAT_owner,date_timestamp,num,VAT_assistant)
            //name,VAT_owner,date_timestamp,num: FK(procedure)
            //VAT_assistant: FK(assistant)


            $sql = "INSERT INTO performed(name, VAT_owner, date_timestamp, num, VAT_assistant) values (?,?,?,?,?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $VAT_assist);
            $result = $stmt->execute();

            if($result === FALSE){
                echo('ERROR performed was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                echo('<br>');
                break;
            }else{
                echo('performed registered in the database successfully.');
                echo('<br>');
            }

            // THIRD insert into test_procedure (only for blood tests)

            //test_procedure(name,VAT_owner,date_timestamp,num,type)
            //name,VAT_owner,date_timestamp,num: FK(procedure)
            //RI: type should be either "blood" or "urine"
            //RI: all tests are required to produce at least one indicator

            $type = "blood"; //hardcoded, since registry is for blood tests only

            $sql = "INSERT INTO test_procedure(name, VAT_owner, date_timestamp, num, type) values (?,?,?,?,?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdsds", $animalName, $VAT_owner, $date, $num, $type);
            $result = $stmt->execute();

            if($result === FALSE){
                echo('ERROR test_procedure was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                echo('<br>');
                break;
            }else{
                echo('test_procedure registered in the database successfully.');
                echo('<br>');
            }
            
            //FINALLY insert into produced_indicators the indicators filled by the doctor in the form

            if(isset($_POST["bloodpH"]) && !empty($_POST["bloodpH"])){
                $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,'blood pH',?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num,$_POST["bloodpH"]);
                $result = $stmt->execute();
        
                if($result === FALSE){
                    echo('ERROR bloodpH indicator was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                    echo('<br>');
                }else{
                    $flag_indicators = TRUE;
                    echo('bloodpH indicator registered in the database successfully.');
                    echo($_POST["bloodpH"]);
                    echo('<br>');
                }

            }
            if(isset($_POST["hemoglobin"]) && !empty($_POST["hemoglobin"])){
                $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,'hemoglobin',?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $_POST["hemoglobin"]);
                $result = $stmt->execute();
        
                if($result === FALSE){
                    echo('ERROR hemoglobin indicator was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                    echo('<br>');
                }else{
                    $flag_indicators = TRUE;
                    echo('hemoglobin indicator registered in the database successfully.');
                    echo($_POST["hemoglobin"]);
                    echo('<br>');
                }
            }
            if(isset($_POST["cholesterol"]) && !empty($_POST["cholesterol"])){
                $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,'cholesterol',?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $_POST["cholesterol"]);
                $result = $stmt->execute();
        
                if($result === FALSE){
                    echo('ERROR cholesterol indicator was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                    echo('<br>');
                }else{
                    $flag_indicators = TRUE;
                    echo('cholesterol indicator registered in the database successfully.');
                    echo($_POST["cholesterol"]);
                    echo('<br>');
                }

            }
            if(isset($_POST["totalProtein"]) && !empty($_POST["totalProtein"])){
                $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,'total protein',?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $_POST["totalProtein"]);
                $result = $stmt->execute();
        
                if($result === FALSE){
                    echo('ERROR total protein indicator was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                    echo('<br>');
                }else{
                    $flag_indicators = TRUE;
                    echo('total protein indicator registered in the database successfully.');
                    echo($_POST["totalProtein"]);
                    echo('<br>');
                }

            }
            if(isset($_POST["creatinine"]) && !empty($_POST["creatinine"])){
                $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,'creatinine',?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $_POST["creatinine"]);
                $result = $stmt->execute();
        
                if($result === FALSE){
                    echo('ERROR creatinine indicator was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                    echo('<br>');
                }else{
                    $flag_indicators = TRUE;
                    echo('creatinine indicator registered in the database successfully.');
                    echo($_POST["creatinine"]);
                    echo('<br>');
                }

            }
            if(isset($_POST["BUN"]) && !empty($_POST["BUN"])){
                $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,'BUN',?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $_POST["BUN"]);
                $result = $stmt->execute();
        
                if($result === FALSE){
                    echo('ERROR BUN indicator was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                    echo('<br>');
                }else{
                    $flag_indicators = TRUE;
                    echo('BUN indicator registered in the database successfully.');
                    echo($_POST["BUN"]);
                    echo('<br>');
                }


            }
            if(isset($_POST["glucose"]) && !empty($_POST["glucose"])){
                $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,'Glucose',?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sdsdd", $animalName, $VAT_owner, $date, $num, $_POST["glucose"]);
                $result = $stmt->execute();
        
                if($result === FALSE){
                    echo('ERROR Glucose indicator was not registered. Execute() failed: ' . htmlspecialchars($stmt->error));
                    echo('<br>');
                }else{
                    $flag_indicators = TRUE;
                    echo('Glucose indicator registered in the database successfully.');
                    echo($_POST["glucose"]);
                    echo('<br>');
                }

            }

            // No indicator was produced for that particular test -> violates the constraint "RI: all tests are required to produce at least one indicator"
            if ($flag_indicators === FALSE){
                echo('ERROR: Violation of the constraint "RI: all tests are required to produce at least one indicator"');
            }
                    
        }else{
            echo('Couldnt register the blood test as no VAT assistant was provided');
            echo('<br>');
        }
        break;
    }


    echo '<form action="index.php">
    <input type="submit" name="Go back" value="Go back to homepage">
    ';



?>