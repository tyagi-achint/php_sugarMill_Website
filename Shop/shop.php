<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Shop</title>
    <style>

    </style>
</head>

<body>
    <div class="half">
        <div class="row">
            <div class="product">
                <img src="organic.png" alt="Organic Sugar">
                <h2>Organic Sugar</h2>
                <p>Price: 100/kg</p>
                <form class='qnty'>
                    <input type='button' value='-' class='qtyminus minus' field='qnty' />
                    <input placeholder="Quantity" type="number" id="organic" min="1" name='qnty' class='qty' />
                    <input type='button' value='+' class='qtyplus plus' field='qnty' />
                </form>
                <button onclick="addToCart('organic',100)">Add to Cart</button>
            </div>

            <div class="product">
                <img src="brown.png" alt="Brown Sugar">
                <h2>Brown Sugar</h2>
                <p>Price: 75/kg</p>
                <form class='qnty'>
                    <input type='button' value='-' class='qtyminus minus' field='qnty' />
                    <input placeholder="Quantity" type="number" id="brown" min="1" name='qnty' class='qty' />
                    <input type='button' value='+' class='qtyplus plus' field='qnty' />
                </form>
                <button onclick="addToCart('brown',75)">Add to Cart</button>
            </div>
        </div>

        <div class="row">
            <div class="product">
                <img src="white.png" alt="White Sugar">
                <h2>White Sugar</h2>
                <p>Price: 50/kg</p>
                <form class='qnty'>
                    <input type='button' value='-' class='qtyminus minus' field='qnty' />
                    <input placeholder="Quantity" type="number" id="white" min="1" name='qnty' class='qty' />
                    <input type='button' value='+' class='qtyplus plus' field='qnty' />
                </form>
                <button onclick="addToCart('white',50)">Add to Cart</button>
            </div>

            <div class="product">
                <img src="liquid.png" alt="Liquid Sugar">
                <h2>Liquid Sugar</h2>
                <p>Price: 45/kg</p>
                <form class='qnty'>
                    <input type='button' value='-' class='qtyminus minus' field='qnty' />
                    <input placeholder="Quantity" type="number" id="liquid" min="1" name='qnty' class='qty' />
                    <input type='button' value='+' class='qtyplus plus' field='qnty' />
                </form>
                <button onclick="addToCart('liquid',45)">Add to Cart</button>
            </div>
        </div>
    </div>



    <div class="otherHalf">

        <div class="back-button">
            <a href="../index.php">Back</a>
        </div>
        <?php
include '../server.php';

$sql = "SELECT * FROM checkout";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // Initialize arrays
    $cartItems = [];

    $totalPrice = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        // Extract user details
        $product = [
            'pName' => mysqli_real_escape_string($con, $row['pro_name']),
            'quantity' => intval($row['pro_quantity']),
            'productPrice' => intval($row['pro_price'])

        ];

        $cartItems[] = $product;

        // Calculate total price
        $totalPrice += $row['pro_quantity'] * $row['pro_price'];
    }

    echo '<script>let cartItems = ' . json_encode($cartItems) . ';</script>';

    echo '
    <div id="cart">
    <h2>Shopping Cart</h2>
    <ul id="cart-items">';

    foreach ($cartItems as $item) {
        $productName = $item['pName'];
        $productQuantity = $item['quantity'];
        $productPice = $item['productPrice'];

        echo '<li>' . $productName . ' x ' . $productQuantity . ' = '.$productPice * $productQuantity. ' </li>';
    }

    echo '</ul>
   <p>Total: <span id="total">' . number_format($totalPrice, 2) . '</span></p>
   <button onclick="checkout()">Checkout</button>
   ';
} else {
    echo '<script>let cartItems = [];</script>
    <div id="cart">
        <h2>Shopping Cart</h2>
        <ul id="cart-items"></ul>
        <p>Total: <span id="total">0.00</span></p>
        <button onclick="checkout()">Checkout</button>
    </div>';
}

mysqli_close($con);
?>



    </div>

    <script src="script.js"></script>
</body>

</html>