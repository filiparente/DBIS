<?php
include_once "conn.php";

//Get the data required in homepage (animal name, owner name and client VAT)
$animalName = $_POST["animalName"];
$ownerName = $_POST["animalOwner"];
$VAT = $_POST["VAT"];

//CHECK IF CLIENT kmnEXISTS

//Prepare sql query to get, from the database, the client with the VAT obtained from the homepage
$stmt = $conn->prepare("select * from client where VAT=?;");
$stmt->bind_param("d",$VAT);
$stmt->execute();
$stmt->store_result();

//If the result has no rows, it means that the VAT is not in the database, so the client is not registered
if($stmt->num_rows == 0){
    echo "VAT not registered as client";
} else {

    //Otherwise, request to the database the person's information using the corresponding VAT number
    $stmt = $conn->prepare("select * from person where VAT=?;");
    $stmt->bind_param("d",$VAT);
    $stmt->execute();
    $result = $stmt->get_result();

    //Display client's info in a table
    echo "Client:";
    echo "<table border='1'><tr><th>Name</th><th>VAT</th><th>Street address</th><th>City</th><th>Zip address</th></tr>";
    while($row = $result->fetch_assoc()){

        //Store the name of the client
        $clientName = $row["name"];

        //Display client's name, VAT, address_street, address_city and address_zip
        echo("<tr><th>".$row["name"]."</th>");
        echo("<th>".$row["VAT"]."</th>");
        echo("<th>".$row["address_street"]."</th>");
        echo("<th>".$row["address_city"]."</th>");
        echo("<th>".$row["address_zip"]."</th></tr>");
    }
    echo "</table><br><br><br>";
}


//Get, from the database, the complete name of the owner and the animal species from the animal's name and (part of) the owner name
$sql = "select a.name animalName, p.name personName, a.species_name speciesName from animal a
join person p on a.name='".$animalName."' and a.VAT=p.VAT and p.name like '%".$ownerName."%';";

$result = $conn->query($sql);
if($result == false){
    echo"false";
}

if($result->num_rows == 0){
    echo "There are no correspondences between animal name and owner name<br>";
    echo "Regist animal: <br>";

    echo '<form action="registanimal.php" method="POST">
    <label for="registerAnimalName">Animal name</label>
    <input type="text" name="registerAnimalName"><br>
    <label for="registerAnimalColour">Animal colour</label>
    <input type="text" name="registerAnimalColour"><br>
    <label for="registerAnimalSpecies">Animal species</label>
    <input type="text" name="registerAnimalSpecies"><br>
    <label for="VAT">Client (Owner) VAT</label>
    <input type="text" name="VAT"><br>
    <label for="registerAnimalGender">Animal gender</label>
    <input type="text" name="registerAnimalGender"><br>
    <label for="registerAnimalBirth">Animal birth year</label>
    <input type="text" name="registerAnimalBirth"><br>
    <input type="submit" name="registerAnimal" value="Register animal">
    ';
} else {
    echo "Animal name ".$animalName." with owner name ".$ownerName.":";
    echo "<table border='1'><tr><th>Animal name</th><th>Species</th><th>Owner name</th></tr>";
    while($row=$result->fetch_assoc()){
        echo "<tr><th><a href='getAnimal.php?animal=".$row["animalName"]."&owner=".$row["personName"]."'>".$row["animalName"]."</a></th>";
        echo "<th>".$row["speciesName"]."</th>";
        echo "<th>".$row["personName"]."</th></tr>";
    }
    echo "</table><br><br><br>";
    $result->data_seek(0);
}

while($row=$result->fetch_assoc()){
    $stmt=$conn->prepare("select c.name animalName, p1.name ownerName, p2.name clientName, c.date_timestamp date from consult c, person p1, person p2 where c.VAT_owner=p1.VAT and p1.name=? and c.name=? and p2.VAT=c.VAT_client ;");
    $stmt->bind_param("ss",$row["personName"],$row["animalName"]);
    $stmt->execute();
    $result1=$stmt->get_result();
    if($result1->num_rows==0){
        echo "There are no consults";
    } else {
        echo "Consults with animal ".$row["animalName"]." and with the owner ".$row["personName"].":";
        echo "<table border='1'><tr><th>Client name</th><th>Animal name</th><th>Date</th><th>Owner name</th></tr>";
        while($row=$result1->fetch_assoc()){
            echo "<tr><th>".$row["clientName"]."</th>";
            echo "<th>".$row["animalName"]."</th>";
            echo "<th>".$row["date"]."</th>";
            echo "<th>".$row["ownerName"]."</th></tr>";
        }
        echo "</table><br><br><br>";
    }
}




