<?php
include '../server.php';

error_reporting(E_ERROR | E_PARSE);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "delete FROM checkout";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $alertClass = 'sucessAlert';
        $alertColor = '#9ADE7B';
        $message = 'Success! Order has been placed.';
        $redirectUrl = 'shopIndex.php';
        $backgroundColor = '#f3f8ff';
    } else {
        $alertClass = 'failureAlert';
        $alertColor = '#ef2928';
        $message = 'Failed! ' . mysqli_error($con);
        $redirectUrl = 'checkout.php';
        $backgroundColor = '#f3f8ff';
    }
    
    echo "
        <head>
            <link rel='stylesheet' href='../style.css'>
            ";
    include '../linkStyles.php';
    echo "
        </head>
        <body style='background-color: $backgroundColor;'>
            <div id='$alertClass' class='alertDiv' style='background-color: $alertColor;'>
                <span id='{$alertClass}close' class='alertButton'><span class='material-symbols-outlined'>
                close
                </span></span>
                <p><b>$message</b> <br><br>Auto redirect in 3 seconds</p>
            </div>
        </body>
        <script>
            let $alertClass = document.getElementById('$alertClass');
            let {$alertClass}close = document.getElementById('{$alertClass}close');
            {$alertClass}close.onclick = function () {
                $alertClass.style.display = 'none';
                window.location.href = '$redirectUrl';
            }
    
            setTimeout(function () {
                window.location.href = '$redirectUrl';
             }, 3000);
    
        </script>";
 
}

$con->close();
?>