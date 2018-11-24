<?php
include_once "conn.php";
$firstName=$_POST["firstName"];
$lastName=$_POST["lastName"];
$query="select * from person where name like '%".$firstName."%' and name like'%".$lastName."%' ;";
$result = $conn->query($query);
while($row = $result->fetch_assoc()){
    echo($row["name"]."\n");
    echo "<br>";
}
