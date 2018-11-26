<?php
    include_once "conn.php";

    $sql='select c.name animalName, p1.name ownerName, p2.name clientName, p3.name vetName, c.date_timestamp date, c.VAT_owner VAT_owner, c.VAT_client VAT_client, c.VAT_vet VAT_vet from consult c, person p1, person p2, person p3 where c.name=? and p1.VAT=c.VAT_owner and p1.name=? and p2.VAT=c.VAT_client and p3.VAT=c.VAT_vet;';
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$_GET["animal"],$_GET["owner"]);
    $stmt->execute();
    $result=$stmt->get_result();
    echo "Consults with animal ".$_GET["animal"]." and with the owner ".$_GET["owner"].":";
    echo "<table border='1'><tr><th>Animal name</th><th>Owner name</th><th>Client name</th><th>Veterinary name</th><th>Date</th></tr>";
    while($row=$result->fetch_assoc()){
        echo "<tr><th>".$row["animalName"]."</th>";
        echo "<th>".$row["ownerName"]."</th>";
        echo "<th>".$row["clientName"]."</th>";
        echo "<th>".$row["vetName"]."</th>";
        echo "<th><a href='getConsult.php?animal=".$row["animalName"]."&owner=".$row["VAT_owner"]."&vet=".$row["VAT_vet"]."&client=".$row["VAT_client"]."&date=".$row["date"]."&clientName=".$row["clientName"]."&ownerName=".$row["ownerName"]."'>"
        .$row["date"]."</th></tr>";
        $ownerName=$row["ownerName"];
    }
    echo "</table><br><br><br>";
    echo "Create new consult for animal ".$_GET["animal"]." with the owner ".$_GET["owner"].":";

echo'
    <form login method="POST" action="createConsult.php?animalName='.$_GET["animal"].'&ownerName='.$_GET["owner"].'">
        <label for="clientName">Client name:</label>
        <input type="text" name="clientName" id="clientName">
        <br>
        <label for="veterinaryName">Veterinary name:</label>
        <input type="text" name="veterinaryName" id="veterinaryName">
        <br>
        <label for="weight">Weight:</label>
        <input type="text" name="weight" id="weight">
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
        <input type="submit" name="createConsult" value="Create consult">
    </form>';

