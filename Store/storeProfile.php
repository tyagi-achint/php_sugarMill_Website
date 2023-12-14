<?php
include '../server.php';

// Assuming you have a session started and 'username' stored in the session
session_start();
$username = $_SESSION['username'];

// Fetch user details from the database
$sql = "SELECT * FROM `store_signup` WHERE `store_username` = '$username'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Extract user details
    $name = $row['store_name'];
    $contact = $row['store_contact'];
    $address = $row['store_address'];
    $displayUsername = $row['store_username'];
} else {
    // Handle the case where user details are not found
    $name = $contact = $address = $displayUsername = "Not available";
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Profile</title>
    <!-- Font  -->
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <!-- CSS  -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style='background: url(storeBackground.jpg) center/cover no-repeat;'>

    <div class="profile-container">
        <h2>Profile</h2>

        <div class="profile-group">
            <h3>Name : <span> <?php echo $name; ?></span></h3>
        </div>

        <div class="profile-group">
            <h3>Contact : <span><?php echo $contact; ?></span></h3>
        </div>

        <div class="profile-group">
            <h3>Address : <span><?php echo $address; ?></span></h3>
        </div>

        <div class="profile-group">
            <h3>Username : <span><?php echo $displayUsername; ?></span></h3>
        </div>


        <div style="text-align:center;">
            <a href="storeHandleUpdate.php">Update</a>
            <a href="store.php">Back</a>
        </div>
    </div>

</body>

</html>