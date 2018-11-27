<?php
    include_once "conn.php";

    $sql='select * from animal where name=? and VAT=?;';
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sd",$_GET["animal"],$_GET["owner"]);
    $stmt->execute();
    $result=$stmt->get_result();
    while($row=$result->fetch_assoc()){
        echo "Animal: ".$_GET["animal"]."<br> Owner: ".$_GET["ownerName"];
        echo "<table border='1'><tr><th>Species</th><th>Colour</th><th>Gender</th><th>Age</th></tr>";
        echo "<tr><th>".$row["species_name"]."</th>";
        echo "<th>".$row["colour"]."</th>";
        echo "<th>".$row["gender"]."</th>";
        echo "<th>".$row["age"]."</th></tr>";
    }
    echo "</table><br><br><br>";

    $sql='select p.name vetName, c.s cs, c.o co, c.a ca, c.p cp, c.weight weight from consult c, person p where c.name=? and c.VAT_owner=? and c.date_timestamp=? and c.VAT_client=? and c.VAT_vet=? and p.VAT=?;';
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sdsddd",$_GET["animal"],$_GET["owner"],$_GET["date"],$_GET["client"],$_GET["vet"],$_GET["vet"]);
    $stmt->execute();
    $result=$stmt->get_result();
    while($row=$result->fetch_assoc()){
        echo "Consults with animal ".$_GET["animal"].", owner ".$_GET["ownerName"].", client ".$_GET["clientName"]." and veterinary ".$row["vetName"]." done on ".$_GET["date"]." :";
        echo "<table border='1'><tr><th>S</th><th>O</th><th>A</th><th>P</th><th>weight</th></tr>";
        echo "<tr><th>".$row["cs"]."</th>";
        echo "<th>".$row["co"]."</th>";
        echo "<th>".$row["ca"]."</th>";
        echo "<th>".$row["cp"]."</th>";
        echo "<th>".$row["weight"]."</th></tr>";
    }
    echo "</table><br><br><br>";

    $sql='select dc.name diagnosis_name from consult_diagnosis cd, diagnosis_code dc, consult c where c.name=? and c.VAT_owner=? and c.date_timestamp=? and cd.name=c.name and cd.VAT_owner=c.VAT_owner and cd.date_timestamp=c.date_timestamp and dc.code=cd.code';
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sds",$_GET["animal"],$_GET["owner"],$_GET["date"]);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows>0){
        echo "<table border='1'><tr><th>Consult diagnosis</th></tr>";
        while($row=$result->fetch_assoc()){
            echo "<tr><th>".$row["diagnosis_name"]."</th></tr>";
        }
        echo "</table><br><br><br>";
    }

    $sql='select pres.name_med name_med, pres.lab lab, pres.dosage dosage, pres.regime regime from prescription pres, consult c where c.name=? and c.VAT_owner=? and c.date_timestamp=? and pres.name=c.name and pres.VAT_owner=c.VAT_owner and pres.date_timestamp=c.date_timestamp;';
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sds",$_GET["animal"],$_GET["owner"],$_GET["date"]);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows>0){
        echo "Prescriptions: <br>";
        echo "<table border='1'><tr><th>Med</th><th>Lab</th><th>Dosage</th><th>Regime</th></tr>";
        while($row=$result->fetch_assoc()){
            echo "<tr><th>".$row["name_med"]."</th>";
            echo "<th>".$row["lab"]."</th>";
            echo "<th>".$row["dosage"]."</th>";
            echo "<th>".$row["regime"]."</th></tr>";
        }
        echo "</table><br><br><br>";
    }

    echo '<form action="index.php">
      <input type="submit" name="Go back" value="Go back to homepage">
      ';
?>
    