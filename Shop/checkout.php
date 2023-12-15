<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="shopStyle.css">
    <?php include '../linkStyles.php';?>
</head>

<body>
    <div class="mainDiv">

        <div class="half">
            <form id="checkoutForm" method='post' action='orderConfirm.php'>
                <h2>Fill the details</h2>
                <input type="text" id="fullName" name="fullName" placeholder="Full Name" required>
                <input type="number" id="contact" name="contact" placeholder="Contact" required>
                <input type="text" id="address" name="address" placeholder="Address" required>
                <input type="text" id="state" name="state" placeholder="State" required>
                <input type="text" id="country" name="country" placeholder="Country" required>
                <input type="number" id="zipCode" name="zipCode" placeholder="ZipCode" required>
            </form>
        </div>

        <div class="other-half">


            <div id="cart">
                <h2>Shopping Cart</h2>
                <?php
include '../server.php';

$sql = "SELECT * FROM checkout";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    $names = [];
    $quantities = [];
    $prices = [];

    $totalPrice = 0; // Initialize total price

    while ($row = mysqli_fetch_assoc($result)) {
        // Extract user details
        $names[] = mysqli_real_escape_string($con, $row['pro_name']);
        $quantities[] = intval($row['pro_quantity']);
        $prices[] = intval($row['pro_price']);

        // Calculate total price
        $totalPrice += $row['pro_quantity'] * $row['pro_price'];
    }

    echo '<table id="cart-items">';


    for ($i = 0; $i < count($names); $i++) {
        $productName = $names[$i];
        $productPrice = $prices[$i];
        $productQuantity = $quantities[$i];

       
        echo '<tr>';
        echo '<td>' . $productName . '</td>';
        echo '<td>*</td> ';
        echo '<td>' . $productQuantity . ' </td>';
        echo '<td> = </td> ';
        echo '<td> ' . $productPrice * $productQuantity . '</td>';
        echo '</tr>';
    }
    echo '</table> ';

  
    echo '<p>Total: <span id="total">'.$totalPrice. '</span></p>';
} else {

    echo "<h3>Cart is Empty</h3>";
    echo '<p>Total: <span id="total">0</span></p>';

}

mysqli_close($con);
?>
                <button onclick="finalCheckout()">Buy</button>
            </div>

            <div class="back-button">
                <a href="shopIndex.php">Back</a>
            </div>
        </div>
    </div>

    <div id="CartalertDiv" style="display:none">
        <?php
            error_reporting(E_ERROR | E_PARSE);
            $alertClass = 'CartfailureAlert';
            $alertColor = '#ef2928';
            $message = 'Please Add Something in Cart';
            $redirectUrl = 'checkout.php';
            echo "
                <head>
                    <link rel='stylesheet' href='../style.css'>

                  
                </head>
                    <div id='$alertClass' class='alertDiv' style='background-color: $alertColor;'>
                        <span id='{$alertClass}close' class='alertButton'><span class='material-symbols-outlined'>
                            close
                        </span></span>
                        <p><b>$message</b></p>
                    </div>
                <script>
                    let $alertClass = document.getElementById('$alertClass');
                    let {$alertClass}close = document.getElementById('{$alertClass}close');
                    {$alertClass}close.onclick = function () {
                        $alertClass.style.display = 'none';
                        window.location.href = '$redirectUrl';
                    }
                   
                </script>
            ";
            ?>
        `;

    </div>


    <div id="AddressalertDiv" style="display:none">
        <?php
            error_reporting(E_ERROR | E_PARSE);
            $alertClass = 'AddressfailureAlert';
            $alertColor = '#ef2928';
            $message = 'Please fill the address field';
            $redirectUrl = 'checkout.php';
            echo "
                <head>
                    <link rel='stylesheet' href='../style.css'>

                  
                </head>
                    <div id='$alertClass' class='alertDiv' style='background-color: $alertColor;'>
                        <span id='{$alertClass}close' class='alertButton'><span class='material-symbols-outlined'>
                            close
                        </span></span>
                        <p><b>$message</b></p>
                    </div>
                <script>
                    let $alertClass = document.getElementById('$alertClass');
                    let {$alertClass}close = document.getElementById('{$alertClass}close');
                    {$alertClass}close.onclick = function () {
                        $alertClass.style.display = 'none';
                        window.location.href = '$redirectUrl';
                    }
                   
                </script>
            ";
            ?>
        `;

    </div>


    <script src="shopScript.js"></script>


</body>

</html>