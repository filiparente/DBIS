<?php
include_once "conn.php";

<<<<<<< HEAD
<<<<<<< HEAD
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
=======
=======

>>>>>>> master
// Start the session
session_start();

if(!isset($_POST["animalName"]) || empty($_POST["animalName"]) || !isset($_POST["animalOwner"]) || empty($_POST["animalOwner"]) || !isset($_POST["VAT"]) || empty($_POST["VAT"])){
    echo('ERROR -  All fields are mandatory.');
    echo('<br>');
    echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
}else{

    //Get the data required in homepage (animal name, owner name and client VAT)
    $animalName = $_POST["animalName"];
    $ownerName = $_POST["animalOwner"];
    $VAT = $_POST["VAT"];

    // Store client VAT in the session (to be used in getAnimal.php)
    $_SESSION["clientVAT"] = $VAT;

    //CHECK IF CLIENT EXISTS

    //Prepare sql query to get, from the database, the client with the VAT obtained from the homepage
<<<<<<< HEAD
    $stmt = $conn->prepare("select * from client where VAT=?;");
>>>>>>> master
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
=======
    try{
        $stmt = $conn->prepare("select * from client where VAT=?;");
        $stmt->bindParam(1, $VAT, PDO::PARAM_INT);
        //$sth->bindParam(2, $colour, PDO::PARAM_STR, 12);
>>>>>>> master
        $stmt->execute();

        //If the result has no rows, it means that the VAT is not in the database, so the client is not registered
        if($stmt->rowCount() == 0){
            echo "VAT not registered as client";
        } else {
            //Otherwise, request to the database the person's information using the corresponding VAT number
            try{
                $stmt = $conn->prepare("select * from person where VAT=?;");
                $stmt->bindParam(1, $VAT, PDO::PARAM_INT);
                $stmt->execute();

                //Display client's info in a table
                echo "Client:";
                echo "<table border='1'><tr><th>Name</th><th>VAT</th><th>Street</th><th>City</th><th>Zip address</th></tr>";
                foreach ($stmt as $row){

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
            }catch(PDOException $e){
                echo('ERROR Couldnt access person. Execute() failed: ' . htmlspecialchars($stmt->error));
                echo('<br>');
            }

            try{
                //Get, from the database, the complete name of the owner and the animal species from the animal's name and (part of) the owner name
                $sql = "select a.name animalName, p.name personName, a.species_name speciesName from animal a
                join person p on a.name=? and a.VAT=p.VAT and p.name like ?;";
                $stmt = $conn->prepare($sql);
                $keyword = "%".$ownerName."%";
                $stmt->bindParam(1, $animalName, PDO::PARAM_STR);
                $stmt->bindParam(2, $keyword, PDO::PARAM_STR);
                $stmt->execute();

                //If the result has no rows, it means that there are no correspondences between the animal name and the (portion of) owner name provided
                if($stmt->rowCount() == 0){
                    echo "There are no correspondences between animal name and owner name<br>";
                    
                    //Option to register a new animal
                    echo "Regist animal: <br>";

                    // Set session variables
                    $_SESSION["registerAnimalName"] = $animalName;
                    $_SESSION["registerVAT"] = $VAT;


                    //Display form to register animal with the client as the owner and go to registanimal.php
                    echo '<form action="registanimal.php" method="POST">
                    <label for="registerAnimalColour">Animal colour*</label>
                    <input type="text" name="registerAnimalColour"><br>
                    <label for="registerAnimalSpecies">Animal species*</label>
                    <input type="text" name="registerAnimalSpecies"><br>
                    <label for="registerAnimalGender">Animal gender*</label>
                    <input type="text" name="registerAnimalGender"><br>
                    <label for="registerAnimalBirth">Animal birth year*</label>
                    <input type="text" name="registerAnimalBirth"><br>
                    
                    <button formaction="registanimal.php">Regist animal</button>
                    <button formaction="index.php">Go back to homepage</button>
                    <p> * - Required fields</p>
                    ';        


                } else {
                    //Display animal name and owner name (or portion of)
                    echo "Animal name ".$animalName." with owner name ".$ownerName.":";

                    // Show a table with the animal name, species and full owner name
                    echo "<table border='1'><tr><th>Animal name</th><th>Species</th><th>Owner name</th><th>Previous consults</th></tr>";
                    foreach ($stmt as $row){

                        //Put a reference to a URL on the animal name: when clicked, execute code on getAnimal.php, passing parameters animal and owner
                        //echo "<tr><th><a href='getAnimal.php?animal=".$row["animalName"]."&owner=".$row["personName"]."'>".$row["animalName"]."</a></th>";
                        echo "<th>".$row["animalName"]."</th>";
                        echo "<th>".$row["speciesName"]."</th>";
                        echo "<th>".$row["personName"]."</th>";
                        echo "<th><a href='getAnimal.php?animal=".$row["animalName"]."&owner=".$row["personName"]."'</a> <button> View </button></th></tr>";
                    }
                    echo "</table><br><br><br>";

                    echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";  
                }
            }catch(PDOException $e){
                echo('ERROR Couldnt query the database for animal-owner matches. Execute() failed: ' . htmlspecialchars($stmt->error));
                echo('<br>');
            }
        }
    }catch(PDOException $e){
        echo('ERROR Couldnt access client. Execute() failed: ' . htmlspecialchars($stmt->error));
        echo('<br>');
    }
}
    