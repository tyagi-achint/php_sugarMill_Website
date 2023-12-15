<?php
include '../server.php';

error_reporting(E_ERROR | E_PARSE);

echo "
    <head>
    <link rel='stylesheet' href='shopStyle.css'>
      
        ";
include '../linkStyles.php';
echo "
    </head>
    <body style='background-color: #bac9dd;'>
        <div id='editCartBox'>
            <span id='editCartBoxclose'><span class='material-symbols-outlined'>
            close
            </span></span>
"; 
$sql = "SELECT * FROM checkout";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    
    $cartItems = [];

    $totalPrice = 0;

    while ($row = mysqli_fetch_assoc($result)) {
       
        $product = [
            'pName' => mysqli_real_escape_string($con, $row['pro_name']),
            'quantity' => intval($row['pro_quantity']),
            'productPrice' => intval($row['pro_price'])

        ];

        $cartItems[] = $product;

        
        $totalPrice += $row['pro_quantity'] * $row['pro_price'];
    }

    echo '<script>let cartItems = ' . json_encode($cartItems) . ';</script>';

    
echo '<form method="post" action="update_quantity.php">
<table id="cart-items">';

echo '
<tr>
<td>Product</td>
<td>Quantity</td>
<td>Price</td>
</tr>
';

foreach ($cartItems as $item) {
    $productName = $item['pName'];
    $productQuantity = $item['quantity'];
    $productPrice = $item['productPrice'];

    echo '
    <tr>
    <td>' . $productName . ' 
    <input type="hidden" name="pName[]" value="' . $productName. '" >
    </td>';
    echo '<td><input type="number" name="quantity[]" value="' . $productQuantity . '"  required></td>';
    echo '<td> ' . $productPrice. '</td>
    </tr>
    ';
}

echo '
</table>
   <button type="submit" >Update</button>
   </form>

   ';
} else {
    echo '<script>let cartItems = [];</script>
        <h2>Cart is Empty</h2>
    ';
}

mysqli_close($con);

echo"</div>
        </body>
    <script>
        let editCartBox = document.getElementById('editCartBox');
        let editCartBoxclose = document.getElementById('editCartBoxclose');
        editCartBoxclose.onclick = function () {
            editCartBox.style.display = 'none';
            window.location.href = 'ShopIndex.php';
        }
    </script>";
?>