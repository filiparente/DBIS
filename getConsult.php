<?php
    include_once "conn.php";

    try{
        $sql='select * from animal where name=? and VAT=?;';
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1, $_GET["animal"], PDO::PARAM_STR);
        $stmt->bindParam(2, $_GET["owner"], PDO::PARAM_INT);
        $stmt->execute();
        
        foreach($stmt as $row){
            echo "Animal: ".$_GET["animal"]."<br> Owner: ".$_GET["ownerName"];
            echo "<table border='1'><tr><th>Species</th><th>Colour</th><th>Gender</th><th>Age</th></tr>";
            echo "<tr><th>".$row["species_name"]."</th>";
            echo "<th>".$row["colour"]."</th>";
            echo "<th>".$row["gender"]."</th>";
            echo "<th>".$row["age"]."</th></tr>";
        }
        echo "</table><br><br><br>";
    }catch(PDOException $e){
        echo('ERROR Couldnt access animal. Execute() failed: ' . htmlspecialchars($stmt->error));
        echo('<br>');
    }

    try{
        $sql='select p.name vetName, c.s cs, c.o co, c.a ca, c.p cp, c.weight weight from consult c, person p where c.name=? and c.VAT_owner=? and c.date_timestamp=? and c.VAT_client=? and c.VAT_vet=? and p.VAT=?;';
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1, $_GET["animal"], PDO::PARAM_STR);
        $stmt->bindParam(2, $_GET["owner"], PDO::PARAM_INT);
        $stmt->bindParam(3, $_GET["date"], PDO::PARAM_STR);
        $stmt->bindParam(4, $_GET["client"], PDO::PARAM_INT);
        $stmt->bindParam(5, $_GET["vet"], PDO::PARAM_INT);
        $stmt->bindParam(6, $_GET["vet"], PDO::PARAM_INT);
        $stmt->execute();

        foreach($stmt as $row){
            echo "Consults with animal ".$_GET["animal"].", owner ".$_GET["ownerName"].", client ".$_GET["clientName"]." and veterinary ".$row["vetName"]." done on ".$_GET["date"]." :";
            echo "<table border='1'><tr><th>S</th><th>O</th><th>A</th><th>P</th><th>weight</th></tr>";
            echo "<tr><th>".$row["cs"]."</th>";
            echo "<th>".$row["co"]."</th>";
            echo "<th>".$row["ca"]."</th>";
            echo "<th>".$row["cp"]."</th>";
            echo "<th>".$row["weight"]."</th></tr>";
        }
        echo "</table><br><br><br>";
    }catch(PDOException $e){
        echo('ERROR Couldnt access the consults from that animal. Execute() failed: ' . htmlspecialchars($stmt->error));
        echo('<br>');
    }

    try{
        $sql='select dc.name diagnosis_name from consult_diagnosis cd, diagnosis_code dc, consult c where c.name=? and c.VAT_owner=? and c.date_timestamp=? and cd.name=c.name and cd.VAT_owner=c.VAT_owner and cd.date_timestamp=c.date_timestamp and dc.code=cd.code';
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1, $_GET["animal"], PDO::PARAM_STR);
        $stmt->bindParam(2, $_GET["owner"], PDO::PARAM_INT);
        $stmt->bindParam(3, $_GET["date"], PDO::PARAM_STR);
        $stmt->execute();
        
        if($stmt->rowCount()>0){
            echo "Consult diagnosis: <br>";
            echo "<table border='1'><tr><th>Consult diagnosis</th></tr>";
            foreach($stmt as $row){
                echo "<tr><th>".$row["diagnosis_name"]."</th></tr>";
            }
            echo "</table><br><br><br>";
        }else{
            echo "No diagnosis for this consult.<br>";
        }
    }catch(PDOException $e){
        echo('ERROR Couldnt access the consult diagnosis from that animal. Execute() failed: ' . htmlspecialchars($stmt->error));
        echo('<br>');
    }

    try{
        $sql='select pres.name_med name_med, pres.lab lab, pres.dosage dosage, pres.regime regime from prescription pres, consult c where c.name=? and c.VAT_owner=? and c.date_timestamp=? and pres.name=c.name and pres.VAT_owner=c.VAT_owner and pres.date_timestamp=c.date_timestamp;';
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1, $_GET["animal"], PDO::PARAM_STR);
        $stmt->bindParam(2, $_GET["owner"], PDO::PARAM_INT);
        $stmt->bindParam(3, $_GET["date"], PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount()>0){
            echo "Prescriptions: <br>";
            echo "<table border='1'><tr><th>Med</th><th>Lab</th><th>Dosage</th><th>Regime</th></tr>";
            
            foreach($stmt as $row){
                echo "<tr><th>".$row["name_med"]."</th>";
                echo "<th>".$row["lab"]."</th>";
                echo "<th>".$row["dosage"]."</th>";
                echo "<th>".$row["regime"]."</th></tr>";
            }
            echo "</table><br><br><br>";
        }else{
            echo "No medications were prescribed for this consult.<br>";
        }
    }catch(PDOException $e){
        echo('ERROR Couldnt access prescribed medications from that animal. Execute() failed: ' . htmlspecialchars($stmt->error));
        echo('<br>');
    }


    echo "<th><a href='formbloodtest.php?animal=".$_GET["animal"]."&owner=".$_GET["owner"]."&vet=".$_GET["vet"]."&client=".$_GET["client"]."&date=".$_GET["date"]."&clientName=".$_GET["clientName"]."&ownerName=".$_GET["ownerName"]."'>
        <button> Regist blood test </button></a></th></tr><br>";

    echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
?>

    