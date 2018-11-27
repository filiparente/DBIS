<?php
include_once "conn.php";
session_start();
function consultNumber($animalName, $year,$conn) {
    $sql="select count(*) number from consult where name=? and year(date_timestamp)=?;";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$animalName,$year);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $number=$row["number"];
        }

    } else {
        $number= "no consults";
    }
    return $number;
}

$_SESSION["number"]=consultNumber($_POST["animalName"],$_POST["year"],$conn);
header("Location:index.php");


