<?php
include '../server.php';

error_reporting(E_ERROR | E_PARSE);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "delete  FROM checkout";
    $result = mysqli_query($con, $sql);

if ($result) {
    echo "
    <head>
<link rel='stylesheet' href='../style.css'>
    </head>
    <body style='background: url(shopBackground.jpg) center/cover no-repeat;'>
    <div id='SignupSuccess' class='AlertLoginSignup' style='background-color: #C3EDC0 !important;'>
    <span id='SignupSuccessclose' class='Alertclosebutton'>&times;</span>
    <p><b>Success!  </b>Order has been placed. </p>
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
                    window.location.href = 'shop.php';
                }, 5000); 
            </script>";
    } else {
        echo "
        <head>
    <link rel='stylesheet' href='../style.css'>
        </head>
        <body style='background: url(shopBackground.jpg) center/cover no-repeat;'>
            <div id='LoginAlrt' class='AlertLoginSignup'>
                <span id='LoginAlrtclose' class='Alertclosebutton'>&times;</span>
                <p><b>Failed!  </b>".mysqli_error($con)."</p>
                <p>Auto redirect in 5 seconds</p>
            </div>
            </body>
            <script>
                let LoginAlrt = document.getElementById('LoginAlrt');
                let LoginAlrtclose = document.getElementById('LoginAlrtclose');
                LoginAlrtclose.onclick = function() {
                    LoginAlrt.style.display = 'none';
                }
                
                setTimeout(function(){
                    window.location.href = 'checkout.php';
                }, 5000); 
            </script>";
    }
}
    
$con->close();
?>