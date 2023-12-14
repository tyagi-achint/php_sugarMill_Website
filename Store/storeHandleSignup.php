
<?php
include '../server.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address']; 
    $confirmPassword = $_POST['confirmPassword'];



    // Check if the username already exists
    $checkUsernameQuery = "SELECT * FROM `store_signup` WHERE `store_username` = '$username'";
    $result = mysqli_query($con, $checkUsernameQuery);
 
    if (mysqli_num_rows($result) > 0) {
        echo "
        <head>
    <link rel='stylesheet' href='../style.css'>
        </head>
        <body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
            <div id='userNameAlrt' class='AlertLoginSignup'>
                <span id='userNameAlrtclose' class='Alertclosebutton'>&times;</span>
                <p><b>Failed!  </b>Username already exists. Please choose a different username. </p>
                <p>Auto redirect in 5 seconds</p>
            </div>
            </body>
            <script>
                let userNameAlrt = document.getElementById('userNameAlrt');
                let userNameAlrtclose = document.getElementById('userNameAlrtclose');
                userNameAlrtclose.onclick = function() {
                    userNameAlrt.style.display = 'none';
                }
            
                setTimeout(function(){
                    window.location.href = 'storeSignup.php';
                }, 5000); 
            </script>";



        echo "";
    } elseif ($password === $confirmPassword) {
    $sql = "INSERT INTO `store_signup` (`store_name`, `store_username`, `store_contact`, `store_address`, `store_password`) VALUES ('$name', '$username', '$contact', '$address', '$password');";
    if (mysqli_query( $con,$sql)){
        echo "
        <head>
    <link rel='stylesheet' href='../style.css'>
        </head>
        <body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
            
                <div id='SignupSuccess' class='AlertLoginSignup' style='background-color: #C3EDC0 !important;'>
    <span id='SignupSuccessclose' class='Alertclosebutton'>&times;</span>
    <p><b>Success!  </b>Details are saved. You can Login now! </p>
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
                    window.location.href = 'storeLogin.php';
                }, 5000); 
            </script>";
        
    }}
    else {
        echo "
        <head>
    <link rel='stylesheet' href='../style.css'>
        </head>
        <body style='background: url(storeBackground.jpg) center/cover no-repeat;'>
            <div id='SingupAlrt' class='AlertLoginSignup'>
                <span id='SingupAlrtclose' class='Alertclosebutton'>&times;</span>
                <p><b>Failed!  </b>Password doesn't match or ".mysqli_error($con)."</p>
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
                    window.location.href = 'storeSignup.php';
                }, 5000); 
            </script>";
        
    }
    
}


?>