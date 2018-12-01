<?php
include_once "conn.php";

// Start session
session_start();

// Function to get the number of consults of a given animal within a given year
function consultNumber($animalName, $VAT_owner, $year, $conn) {

    // Query to count the number of consults of that animal in that year
    $sql = "select count(*) number from consult where name=? and VAT_owner=? and year(date_timestamp)=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $animalName, $VAT_owner, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the result has rows, there are (possibly more than 1) consults with that animal in that year
    if($result->num_rows > 0){

            $row = $result->fetch_assoc();

            // Store the number of consults
            $number = $row["number"];
    } else {
        // Otherwise there are no consults with that animal in that year
        $number = 0;
    }
    return $number;
}
$sql = "select VAT from person where name like %".$_POST["ownerName"]."%';";

$result = $conn->query($sql);
$ownerVAT = $result["VAT"];

$_SESSION["number"] = consultNumber($_POST["animalName"], $ownerVAT,$_POST["year"], $conn);
echo "Number of consults with animal ".$_POST["animalName"].", owner ".$_POST["ownerName"].", in ".$_POST["year"].": ";
echo $_SESSION["number"];
echo '<form action="index.php">
      <input type="submit" name="Go back to homepage" value="Go back to homepage">
    ';
//header("Location:index.php");


