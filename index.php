<?php
    include_once "conn.php";
    session_start();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIBD - Veterinary Hospital</title>
</head>
<body>
    <form login method="POST" action="query1.php">
        <label for="VAT">Client VAT*:</label>
        <select id="VAT" name="VAT">
        <!--<option selected="selected">Client VAT:</option>-->
        <?php
        $sql = 'select VAT from client;';
        $result = $conn->query($sql);

        if ($result == FALSE)
        {
            $info = $conn->errorInfo();
            echo("<p>Error: {$info[2]}</p>");
            exit();
        }
        
       foreach($result as $row) {
            $code = $row["VAT"];
        ?>
        <option name="VAT" value="<?php echo($code); ?>"><?php echo $code; ?></option>
        <?php
        }
        ?>
        </select>

        <label for="animalName">Animal name*:</label>
        <input type="text" id="animalName" name="animalName">
        <label for="animalOwner">Owner name*:</label>
        <input type="text" name="animalOwner" id="animalOwner">
        <input type="submit" name="query1" value="Check">
        <p> * - Required fields </p>
    </form>
    <br>
    <form login method="POST" action="consultNumber.php">
        <label for="animalName">Animal name:</label>
        <input type="text" name="animalName" id="animalName">
        <label for="ownerName"> Owner Name:</label>
        <input type="text" name="ownerName" id="ownerName">
        <label for="year">Year:</label>
        <input type="text" name="year" id="year">
        <input type="submit" value="Number of consults">
    </form>    
</body>
</html>