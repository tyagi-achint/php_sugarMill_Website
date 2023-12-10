<?php
include '../server.php';

error_reporting(E_ERROR | E_PARSE);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $names =$_POST['pro_name'];
    $quantities =$_POST['pro_quantity'];
    $prices = $_POST['pro_price'];

    for ($i = 0; $i < count($names); $i++) {
        $productName = mysqli_real_escape_string($con, $names[$i]);
        $productPrice = floatval($prices[$i]); // Convert to float to ensure correct storage
        $productQuantity =  intval($quantities[$i]) ; // Convert to int to ensure correct storage

        // Check if the product already exists in the database
        $checkQuery = "SELECT * FROM `checkout` WHERE `pro_name` = '$productName'";
        $result = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            
            $updateQuery = "UPDATE `checkout` SET `pro_quantity` = $productQuantity WHERE `pro_name` = '$productName'";
            mysqli_query($con, $updateQuery);


        } else {
            // If the product doesn't exist, insert a new entry
            $insertQuery = "INSERT INTO `checkout` (`pro_name`, `pro_quantity`, `pro_price`) VALUES ('$productName', $productQuantity, $productPrice)";
            mysqli_query($con, $insertQuery);
        }
    }
}

mysqli_close($con);
header('location: checkout.php');
?>