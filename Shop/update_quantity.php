<?php
include '../server.php';

error_reporting(E_ERROR | E_PARSE);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $names = $_POST['pName'];
    $quantities = $_POST['quantity'];

    for ($i = 0; $i < count($names); $i++) {
        $productName = mysqli_real_escape_string($con, $names[$i]);
        
        $productQuantity = intval($quantities[$i]); 

        $checkQuery = "SELECT * FROM `checkout` WHERE `pro_name` = '$productName'";
        $result = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
           
            $updateQuery = "UPDATE `checkout` SET `pro_quantity` = $productQuantity WHERE `pro_name` = '$productName'";
            mysqli_query($con, $updateQuery);
        }
    }

 
 
}
mysqli_close($con);
header('location: shopIndex.php');

?>