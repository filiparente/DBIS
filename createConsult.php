<?php
    include_once "conn.php";

    $animalName=$_GET["animalName"];
    $ownerName=$_GET["ownerName"];

    $sql="select p1.VAT clientVAT, p2.VAT vetVAT, p3.VAT ownerVAT from person p1, person p2, person p3 where p1.name=? and p2.name=? and p3.name=?;";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss",$_POST["clientName"],$_POST["veterinaryName"],$ownerName);
    $stmt->execute();
    $result=$stmt->get_result();
    while($row=$result->fetch_assoc()){
        $clientVAT=$row["clientVAT"];
        $vetVAT=$row["vetVAT"];
        $ownerVAT=$row["ownerVAT"];
    }
    $date=date("Y-m-d h:i:s");
    //echo $animalName, $ownerVAT,  $_POST['S'], $_POST['O'], $_POST['A'], $_POST['P'], $clientVAT, $vetVAT, $_POST['weight'];
    $sql="insert into consult (name,VAT_owner, date_timestamp,s,o,a,p,VAT_client,VAT_vet,weight) values (?,?,?,?,?,?,?,?,?,?);";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sdsssssddd",$animalName,$ownerVAT,$date,$_POST["S"],$_POST["O"],$_POST["A"],$_POST["P"],$clientVAT,$vetVAT,$_POST["weight"]);
    $stmt->execute();
    header("Location: getAnimal.php");
    