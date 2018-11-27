<?php
    include_once "conn.php";

    // Start session with query1.php
    session_start();

    $sql = 'select c.name animalName, p1.name ownerName, p2.name clientName, p3.name vetName, c.date_timestamp date, c.VAT_owner VAT_owner, c.VAT_client VAT_client, c.VAT_vet VAT_vet from consult c, person p1, person p2, person p3 where c.name=? and p1.VAT=c.VAT_owner and p1.name=? and p2.VAT=c.VAT_client and p3.VAT=c.VAT_vet;';
    $stmt = $conn->prepare($sql);

    //Bind parameters. GET animal and owner from query1.php
    $stmt->bind_param("ss", $_GET["animal"], $_GET["owner"]);
    $stmt->execute();
    $result = $stmt->get_result();

    //Display consults with that animal and that owner
    echo "Consults with animal ".$_GET["animal"]." and with the owner ".$_GET["owner"].":";
    
    //Display animal name, owner name, client name, veterinary doctor name, and consult date
    echo "<table border='1'><tr><th>Animal name</th><th>Owner name</th><th>Client name</th><th>Veterinary name</th><th>Date</th></tr>";
    
    //For each consult where that animal and owner participated
    while($row = $result->fetch_assoc()){
        //Display
        echo "<tr><th>".$row["animalName"]."</th>";
        echo "<th>".$row["ownerName"]."</th>";
        echo "<th>".$row["clientName"]."</th>";
        echo "<th>".$row["vetName"]."</th>";

        //Put a reference to a URL on the date: when clicked, execute code on getConsult.php, passing parameters animal name and owner, vet and client VAT's and name's, and the date
        echo "<th><a href='getConsult.php?animal=".$row["animalName"]."&owner=".$row["VAT_owner"]."&vet=".$row["VAT_vet"]."&client=".$row["VAT_client"]."&date=".$row["date"]."&clientName=".$row["clientName"]."&ownerName=".$row["ownerName"]."'>"
        .$row["date"]."</th></tr>";

        //Store owner name
        $ownerName = $row["ownerName"];
    }
    echo "</table><br><br><br>";

    //Option to create a new consult for that animal and owner
    echo "Create new consult for animal ".$_GET["animal"]." with the owner ".$_GET["owner"].":";

    //Display form to create a consult for that animal and owner and go to createConsult.php      
    echo'   <form login method="POST" action="createConsult.php?animalName='.$_GET["animal"].'&ownerName='.$_GET["owner"].'">
            <label for="veterinaryVAT">Veterinary VAT:</label>
            <input type="number" name="veterinaryVAT" id="veterinaryVAT">
            <br>
            <label for="weight">Weight:</label>
            <input type="number" name="weight" id="weight">
            <br>
            <label for="S">S:</label>
            <input type="text" name="S" id="S">
            <br>
            <label for="O">O:</label>
            <input type="text" id="O" name="O">
            <br>
            <label for="A">A:</label>
            <input type="text" name="A" id="A">
            <br>
            <label for="P">P:</label>
            <input type="text" name="P" id="P">
            <br>
            <label for="DiagnosticCodes">Diagnostic codes: (for multiple diagnosis use the following format: [nº diagnosis1+nºdiagnosis2+...] Ex.: 3+5+14)</label>
            <input type="text" name="DiagnosticCodes" id="DiagnosticCodes"/>
            <br>
            <input type="submit" name="createConsult" value="Create consult">
            </form>';

echo '<form action="index.php">
      <input type="submit" name="Go back" value="Go back to homepage">
      ';
?>
