<?php

include '../server.php';
// Assuming you have a table named 'your_table' with columns 'id', 'name', 'age', 'city'

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attributeToUpdate = $_POST['attributeToUpdate'];
    $newValue = $_POST['newValue'];

// Start the session
session_start();

// Access the session variable
$username = $_SESSION['username'];

    switch ($attributeToUpdate) {
        case 'name':
            $sql = "UPDATE `store_signup` SET `store_name` = '$newValue' WHERE `store_username` = '$username'";
            break;
        case 'contact':
            $sql = "UPDATE `store_signup` SET `store_contact` = '$newValue' WHERE `store_username` = '$username'";
            break;
        case 'address':
            $sql = "UPDATE `store_signup` SET `store_address` = '$newValue' WHERE `store_username` = '$username'";
            break;
        default:
            echo "Invalid attribute to update";
            break;
    }

    if ($con->query($sql) === TRUE) {
        echo "
        <head>
    <link rel='stylesheet' href='../style.css'>
        </head>
        <body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
            
                <div id='updateSuccess' class='AlertLoginSignup' style='background-color: #C3EDC0 !important;'>
    <span id='updateSuccessclose' class='Alertclosebutton'>&times;</span>
    <p><b>Success!  </b>Details are updated</p>
        
            </div>
            </body>
            <script>
                let updateSuccess = document.getElementById('updateSuccess');
                let updateSuccessclose = document.getElementById('updateSuccessclose');
                updateSuccessclose.onclick = function() {
                    updateSuccess.style.display = 'none';
                }
            
              
            </script>";
    } else {
       
        echo "
        <head>
    <link rel='stylesheet' href='../style.css'>
        </head>
        <body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
            <div id='updateFailed' class='AlertLoginSignup'>
                <span id='updateFailedclose' class='Alertclosebutton'>&times;</span>
                <p><b>Error updating record:  </b> ". $con->error."</p>
               
            </div>
            </body>
            <script>
                let updateFailed = document.getElementById('updateFailed');
                let updateFailedclose = document.getElementById('updateFailedclose');
                updateFailedclose.onclick = function() {
                    updateFailed.style.display = 'none';
                }
            
            </script>";
    }
}
?>

<!-- HTML form to input data -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Font  -->
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <!-- CSS  -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
    <div class="update-container">
        <h2>
            Attribute to Update:
        </h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <select name="attributeToUpdate">
                <option value="name">Name</option>
                <option value="contact">Contact</option>
                <option value="address">Adress</option>
            </select><br>
            <input type="text" name="newValue" placeholder="New Value" required><br>
            <input type="submit" value="Update">
        </form>

        <a href="storeProfile.php">Back</a>

    </div>

</body>

</html>