<?php
    include_once "conn.php";

    $animalName = $_GET["animal"];
    $clientName = $_GET["clientName"];
    $ownerName = $_GET["ownerName"];

    $VAT_owner = $_GET["owner"];
    $VAT_vet = $_GET["vet"];
    $VAT_client = $_GET["client"];

    echo($animalName);
    echo($VAT_owner);

    $date = $_GET["date"];
?>

<html>
    <body>
        <!--Display form to create a consult for that animal and owner and go to createConsult.php  -->    
        <?php echo'<form login method="POST" action="registbloodtest.php?animalName='.$animalName.'&clientName='.$clientName.'&ownerName='.$ownerName.'&VAT_owner='.$VAT_owner.'&VAT_vet='.$VAT_vet.'&VAT_client='.$VAT_client.'&date='.$date.'"'?>
        <label for="VAT_assist">VAT of the assistant:</label>
        <select name="VAT_assist">
        <?php
            $sql = 'select VAT from assistant;';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            foreach($stmt as $row){
                $code = $row["VAT"];
                echo("<option value=\"$code\">$code</option>");
            }
            
        ?>    
        </select>
        <!--
        <label for="whitebloodcell">White blood cells count:</label>
        <input type="number" name="whitebloodcell" id="whitebloodcell">
        <br>
        <label for="neutrophils">Number of neutrophils:</label>
        <input type="number" name="neutrophils" id="neutrophils">
        <br>
        <label for="lymphocytes">Number of lymphocytes:</label>
        <input type="number" name="lymphocytes" id="lymphocytes">
        <br>
        <label for="monocytes">Number of monocytes:</label>
        <input type="number" name="monocytes" id="monocytes">
        <br>
        -->
        <br>
        <label for="bloodpH">Blood pH:</label>
        <input type="number" name="bloodpH" id="bloodpH" min="0" max="12" step="any">
        <br>
        <label for="hemoglobin">Hemoglobin [mg/dl]:</label>
        <input type="number" name="hemoglobin" id="hemoglobin" min="0" max="30" step="any">
        <br>
        <label for="cholesterol">Cholesterol [mg/dl]:</label>
        <input type="number" name="cholesterol" id="cholesterol" min="40" max="400" step="any">
        <br>
        <label for="totalProtein">Total protein [g]:</label>
        <input type="number" name="totalProtein" id="totalProtein" min="0" max="10" step="any">
        <br>
        <label for="creatinine">Creatinine [mg/dl]:</label>
        <input type="number" name="creatinine" id="creatinine" min="0" max="2" step="any">
        <br>
        <label for="BUN">BUN [mg/dl]:</label>
        <input type="number" name="BUN" id="BUN" min="0" max="50" step="any">
        <br>
        <label for="glucose">Glucose [mg/dl]:</label>
        <input type="number" name="glucose" id="glucose" min="20" max="200" step="any">
        <br>
        <input type="submit" name="Regist blood test" value="Regist blood test">
        </form>

        <a href='index.php'> <button> Go back to homepage </button></a><br>
    </body> 
</html>


    