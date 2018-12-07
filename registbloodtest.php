<?php
    include_once "conn.php";

    if((!isset($_POST["bloodpH"]) || empty($_POST["bloodpH"])) && (!isset($_POST["hemoglobin"]) || empty($_POST["hemoglobin"])) && (!isset($_POST["cholesterol"]) || empty($_POST["cholesterol"])) && (!isset($_POST["totalProtein"]) || empty($_POST["totalProtein"])) && (!isset($_POST["BUN"]) || empty($_POST["BUN"])) && (!isset($_POST["glucose"]) || empty($_POST["glucose"])) && (!isset($_POST["creatinine"]) || empty($_POST["creatinine"]))){
        echo('ERROR No indicator filled in.');
        echo('<br>');
    }else{

        // Begin transaction
        $conn->beginTransaction();

        // Get variables
        $animalName = $_POST["animalName"];
        $clientName = $_POST["clientName"];
        $ownerName = $_POST["ownerName"];
        $VAT_owner = $_POST["VAT_owner"];
        $VAT_vet = $_POST["VAT_vet"];
        $VAT_client = $_POST["VAT_client"];
        $date = $_POST["date"];

        $indicators_array = ["bloodpH", "hemoglobin","cholesterol", "totalProtein", "creatinine", "BUN", "glucose"];

        // Flags
        $norollback = TRUE;
        $flag_indicators = FALSE;

        // Check num of the last procedure and increment it
        $sql = "select max(num) as max_procedure from procedures where name=? and VAT_owner=? and date_timestamp=?;";
        $stmt = $conn->prepare($sql);
        
        try{
            $stmt->bindParam(1, $animalName, PDO::PARAM_STR);
            $stmt->bindParam(2, $VAT_owner, PDO::PARAM_INT);
            $stmt->bindParam(3, $date, PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() == 0){
                $num = 1;
            }else{
                foreach($stmt as $row){
                    $num = $row["max_procedure"]+1;
                }
            }
        }catch(PDOException $e){
            echo('ERROR couldnt access procedures num' . $e->getMessage());
            echo('<br>');
            $conn->rollBack();
            $norollback = FALSE;

            echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
        }
            
        
        
        if(isset($_POST["VAT_assist"])){
            $VAT_assist = $_POST["VAT_assist"];
            // FIRST insert into procedures
            $sql = "INSERT INTO procedures(name, VAT_owner, date_timestamp, num, description) values (?,?,?,?,'blood test');";
            $stmt = $conn->prepare($sql);

            try{
                $stmt->bindParam(1, $animalName, PDO::PARAM_STR);
                $stmt->bindParam(2, $VAT_owner, PDO::PARAM_INT);
                $stmt->bindParam(3, $date, PDO::PARAM_STR);
                $stmt->bindParam(4, $num, PDO::PARAM_INT);
                $stmt->execute();

            }catch(PDOException $e){
                echo('ERROR procedure was not registered.' . $e->getMessage());
                echo('<br>');
                $conn->rollBack();
                $norollback = FALSE;

                echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
            }

            // SECOND insert into performed
            $sql = "INSERT INTO performed(name, VAT_owner, date_timestamp, num, VAT_assistant) values (?,?,?,?,?);";
            $stmt = $conn->prepare($sql);

            try{
                $stmt->bindParam(1, $animalName, PDO::PARAM_STR);
                $stmt->bindParam(2, $VAT_owner, PDO::PARAM_INT);
                $stmt->bindParam(3, $date, PDO::PARAM_STR);
                $stmt->bindParam(4, $num, PDO::PARAM_INT);
                $stmt->bindParam(5, $VAT_assist, PDO::PARAM_INT);
            }catch(PDOException $e){
                echo('ERROR performed was not registered.' . $e->getMessage());
                echo('<br>');
                $conn->rollBack();
                $norollback = FALSE;

                echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
            }


            // THIRD insert into test_procedure (only for blood tests)
            $type = "blood"; //hardcoded, since registry is for blood tests only

            $sql = "INSERT INTO test_procedure(name, VAT_owner, date_timestamp, num, type) values (?,?,?,?,?);";
            $stmt = $conn->prepare($sql);

            try{
                $stmt->bindParam(1, $animalName, PDO::PARAM_STR);
                $stmt->bindParam(2, $VAT_owner, PDO::PARAM_INT);
                $stmt->bindParam(3, $date, PDO::PARAM_STR);
                $stmt->bindParam(4, $num, PDO::PARAM_INT);
                $stmt->bindParam(5, $type, PDO::PARAM_STR);
                
                $stmt->execute();
            }catch(PDOException $e){
                echo('ERROR test_procedure was not registered.' . $e->getMessage());
                echo('<br>');
                $conn->rollBack();
                $norollback = FALSE;

                echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
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
                echo('<br>');
                $conn->rollBack();
                $norollback = FALSE;
            }

            if($norollback === TRUE){
                $conn->commit();
                echo('Blood test registered in the database successfully!');
                echo('<br>');
            }

        }else{
            echo('Couldnt register the blood test as no VAT assistant was provided');
            echo('<br>');
        }
    }
        

    echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";

    function register_indicator($norollback,$flag_indicators, $conn, $animalName, $VAT_owner, $date, $num, $indicator_name) {
        $sql = "INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, value) values (?,?,?,?,?,?);";
        $stmt = $conn->prepare($sql);
        
        try{
    
            $stmt->bindParam(1, $animalName, PDO::PARAM_STR);
            $stmt->bindParam(2, $VAT_owner, PDO::PARAM_INT);
            $stmt->bindParam(3, $date, PDO::PARAM_STR);
            $stmt->bindParam(4, $num, PDO::PARAM_INT);
            $stmt->bindParam(5, $indicator_name, PDO::PARAM_STR);
            $stmt->bindParam(6, $_POST[$indicator_name], PDO::PARAM_INT);

            $stmt->execute();
            $flag_indicators = TRUE;
        }catch(PDOException $e){
            echo("ERROR '".$indicator_name."' indicator was not registered" . $e->getMessage());
            echo('<br>');
            $conn->rollBack();
            $norollback = FALSE;
            $flag_indicators = FALSE;

            echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
        }

        return array($norollback, $flag_indicators);
    }

?>