<?php
include '../server.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Product = $_POST['Product'];
    $Weight = $_POST['Weight'];
// Set the time zone to your preferred location
date_default_timezone_set("Asia/Calcutta");

// Get the current date in dd-mm-yyyy format
$currentDate = date('d-m-Y H:i:s');

// Access the session variable
$username = $_SESSION['username'];

    if($Weight<=100 || $Weight>=10){
        $sql = "INSERT INTO `sugar_order` ( `sh_username`, `product`, `weight`, `date`) VALUES ( '$username', '$Product', '$Weight', '$currentDate');";
        if (mysqli_query( $con,$sql)){
            echo "
            <head>
        <link rel='stylesheet' href='../style.css'>
            </head>
            <body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
                
                    <div id='SignupSuccess' class='AlertLoginSignup' style='background-color: #C3EDC0 !important;'>
        <span id='SignupSuccessclose' class='Alertclosebutton'>&times;</span>
        <p><b>Success!  </b>Request has been sent </p>
                    <p>Auto redirect in 5 seconds</p>
                </div>
                </body>
                <script>
                    let SignupSuccess = document.getElementById('SignupSuccess');
                    let SignupSuccessclose = document.getElementById('SignupSuccessclose');
                    SignupSuccessclose.onclick = function() {
                        SignupSuccess.style.display = 'none';
                    }
                
                    setTimeout(function(){
                        window.location.href = 'storeOrder.php';
                    }, 5000); 
                </script>";
            
        }
        else {
            echo "
            <head>
        <link rel='stylesheet' href='../style.css'>
            </head>
            <body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
                <div id='SingupAlrt' class='AlertLoginSignup'>
                    <span id='SingupAlrtclose' class='Alertclosebutton'>&times;</span>
                    <p><b>Failed!  </b> ".mysqli_error($con)."</p>
                    <p>Auto redirect in 5 seconds</p>
                </div>
                </body>
                <script>
                    let SingupAlrt = document.getElementById('SingupAlrt');
                    let SingupAlrtclose = document.getElementById('SingupAlrtclose');
                    SingupAlrtclose.onclick = function() {
                        SingupAlrt.style.display = 'none';
                    }
                
                    setTimeout(function(){
                        window.location.href = 'storeBuy.php';
                    }, 5000); 
                </script>";
            
        }
    }else{
        echo "
            <head>
        <link rel='stylesheet' href='../style.css'>
            </head>
            <body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
                <div id='SingupAlrt' class='AlertLoginSignup'>
                    <span id='SingupAlrtclose' class='Alertclosebutton'>&times;</span>
                    <p><b>Failed!  </b>Weight is above 100 or less than 10</p>
                    <p>Auto redirect in 5 seconds</p>
                </div>
                </body>
                <script>
                    let SingupAlrt = document.getElementById('SingupAlrt');
                    let SingupAlrtclose = document.getElementById('SingupAlrtclose');
                    SingupAlrtclose.onclick = function() {
                        SingupAlrt.style.display = 'none';
                    }
                
                    setTimeout(function(){
                        window.location.href = 'storeBuy.php';
                    }, 5000); 
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
    <style>
    .quality_options {
        width: 100%;
        padding: 8px;
        color: grey;
        background-color: transparent;
        font-weight: bold;
        margin-bottom: 10px;
        box-sizing: border-box;
        border: 2px solid #B6BBC4;
        border-radius: 4px;
        font-size: medium;
    }

    .quality_options label {
        display: inline-block;
    }

    .quality_options h3 {
        font-weight: bold;
        text-align: left;
        margin-top: 0;
        margin-bottom: 5px;
    }
    </style>
</head>

<body style='background: url(storeBackground.jpg) center/cover no-repeat;'>

    <div class="selling-container">
        <h2>Buy Sugar</h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <input type="text" id="Weight" name="Weight" placeholder="Weight kg (More than 10 Less than 100)" required>
            <div class="quality_options">
                <h3>Select Product:</h3>
                <label>
                    <input type="radio" name="Product" value="Brown" required>Brown
                </label>
                <label>
                    <input type="radio" name="Product" value="White" required>White
                </label>
                <label>
                    <input type="radio" name="Product" value="Liquid" required>Liquid
                </label>
                <label>
                    <input type="radio" name="Product" value="Organic" required>Organic
                </label>
            </div>

            <button type="submit">Request For Buy</button>
        </form>

        <p><button><a href="store.php">Back</a></button></p>

    </div>

</body>

</html>