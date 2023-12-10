<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <style>
    form {
        text-align: center;
    }

    form h2 {
        text-align: left;
    }

    input {
        width: 80%;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="half ">
            <form method='post' action='thankyou.php'>
                <h2>Fill the details</h2>
                <input type="text" id="fullName" name="fullName" placeholder="Full Name" required>
                <input type="number" id="contact" name="contact" placeholder="Contact" required>
                <input type="text" id="address" name="address" placeholder="Address" required>
                <input type="text" id="state" name="state" placeholder="State" required>
                <input type="text" id="country" name="country" placeholder="Country" required>
                <input type="number" id="zipCode" name="zipCode" placeholder="ZipCode" required>
            </form>
        </div>
        <div class="otherHalf">
            <div class="back-button">
                <a href="shop.php">Back</a>
            </div>

            <div id="cart">
                <h2>Shopping Cart</h2>
                <?php
include '../server.php';

$sql = "SELECT * FROM checkout";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Initialize arrays
    $names = [];
    $quantities = [];
    $prices = [];

    $totalPrice = 0; // Initialize total price

    while ($row = mysqli_fetch_assoc($result)) {
        // Extract user details
        $names[] = mysqli_real_escape_string($con, $row['pro_name']);
        $quantities[] = intval($row['pro_quantity']);
        $prices[] = floatval($row['pro_price']);

        // Calculate total price
        $totalPrice += $row['pro_quantity'] * $row['pro_price'];
    }

    echo '<ul id="cart-items">';


    for ($i = 0; $i < count($names); $i++) {
        $productName = $names[$i];
        $productPrice = $prices[$i];
        $productQuantity = $quantities[$i];

        echo '<li>' . $productName . ' x ' . $productQuantity . ' = ' . ($productQuantity * $productPrice) . '</li>';
    }

    echo '</ul>';

  
    echo '<p>Total: <span id="total">' . number_format($totalPrice, 2) . '</span></p>';
} else {

    echo "<h3>Cart is Empty</h3>";

    echo '<p>Total: <span id="total">0.00</span></p>';

}

mysqli_close($con);
?>
                <button onclick="finalCheckout()">Buy</button>
            </div>


        </div>

    </div>

    <script>
    function finalCheckout() {
        var total = document.getElementById("total");
        if (total.innerHTML === "0.00") {
            alert("Please Add Something in Cart...");
        } else {
            const inputElements = document.querySelectorAll('form input');

            function checkForm() {
                for (const input of inputElements) {
                    if (input.type !== 'button' && input.value.trim() === '') {
                        return false;
                    }
                }

                return true;
            }
            if (checkForm()) {
                const form = document.querySelector('form');
                form.submit();
            } else {
                alert("Please Fill the form... ");
            }
        }


    }
    </script>


</body>

</html>