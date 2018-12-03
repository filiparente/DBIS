<?php
include_once "conn.php";

if((!isset($_POST["animalName"]) || empty($_POST["animalName"])) || (!isset($_POST["ownerName"]) || empty($_POST["ownerName"])) || (!isset($_POST["year"]) || empty($_POST["year"]))){
    echo('ERROR -  All fields are mandatory.');
    echo('<br>');
    echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
}else{

    $sql = "select VAT from person where name like ?;";
    $stmt = $conn->prepare($sql);

    try{
        $keyword = "%".$_POST["ownerName"]."%";
        $stmt->bindParam(1, $keyword, PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e)
    {
        echo("ERROR couldnt acess person.");
        echo('<br>');
    }

    foreach ($stmt as $row){
        $ownerVAT = $row["VAT"];
    }

    $n = consultNumber($_POST["animalName"], $ownerVAT, $_POST["year"], $conn);
    echo "Number of consults with animal ".$_POST["animalName"].", owner ".$_POST["ownerName"].", in ".$_POST["year"].": ";
    echo($n);
    echo "<a href='index.php'> <button> Go back to homepage </button></a><br>";
    //header("Location:index.php");

}

// Function to get the number of consults of a given animal within a given year
function consultNumber($animalName, $VAT_owner, $year, $conn) {

    // Query to count the number of consults of that animal in that year
    $sql = "select count(*) number from consult where name=? and VAT_owner=? and year(date_timestamp)=?;";
    $stmt = $conn->prepare($sql);

    try{
        $stmt->bindParam(1, $animalName, PDO::PARAM_STR);
        $stmt->bindParam(2, $VAT_owner, PDO::PARAM_INT);
        $stmt->bindParam(3, $year, PDO::PARAM_INT);
        $stmt->execute();

        // If the result has rows, there are (possibly more than 1) consults with that animal in that year
        if($stmt->rowCount() > 0){
                foreach($stmt as $row){
                // Store the number of consults
                    $number = $row["number"];
                }
        } else {
            // Otherwise there are no consults with that animal in that year
            $number = 0;
        }
    }catch(PDOException $e)
    {
        echo("ERROR Couldnt access consults.");
        echo('<br>');

        return 0;
    }

    return $number;
}
?>