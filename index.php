<?php
    include_once "conn.php";
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
        <label for="VAT">Client VAT:</label>
        <input type="text" name="VAT" id="VAT">
        <label for="animalName">Animal name:</label>
        <input type="text" id="animalName" name="animalName">
        <label for="animalOwner">Owner name:</label>
        <input type="text" name="animalOwner" id="animalOwner">
        <input type="submit" name="query1" value="Check">
    </form>
    </body>
</html>