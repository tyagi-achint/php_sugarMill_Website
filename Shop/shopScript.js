
// Function to add items to the cart
function addToCart(productName, productPrice) {
    const quantityInput = document.getElementById(getInputId(productName));

    let quantity = parseInt(quantityInput.value);
    let pName = capFrstLtr(productName + " sugar");

    if (isNaN(quantity) || quantity < 1 || quantity > 20) {
        alert('Please enter a valid quantity between 1 and 20.');
        return;
    }

    // Check if the item is already in the cart
    const existingItem = cartItems.find(item => item.pName === pName);

    if (existingItem) {
        // If the item is already in the cart, update the quantity
        existingItem.quantity += quantity;


    } else {
        // If the item is not in the cart, add it to the client-side cart
        cartItems.push({ pName, quantity, productPrice });

    }

    // Update the cart display
    updateCart();
}
function updateCart() {
    const cartItemsElement = document.getElementById('cart-items');
    const totalElement = document.getElementById('total');
    let totalCost = 0;

    // Clear the existing cart items
    cartItemsElement.innerHTML = '';

    // Loop through the cart items and update the display
    cartItems.forEach(item => {
        const product = getProductByName(item.pName);

        // Display each item in the cart
        const li = document.createElement('li');
        const table = document.createElement('table');
        const tr = document.createElement('tr');

        // Create and append the first cell (product name)
        const td1 = document.createElement('td');
        td1.textContent = product.name;
        tr.appendChild(td1);

        // Create and append the second cell (multiplication symbol)
        const td2 = document.createElement('td');
        td2.textContent = '*';
        tr.appendChild(td2);

        // Create and append the third cell (product quantity)
        const td3 = document.createElement('td');

        // Limit displayed quantity to 20
        const displayedQuantity = Math.min(item.quantity, 20);
        td3.textContent = displayedQuantity;

        tr.appendChild(td3);

        // Create and append the fourth cell (equal symbol)
        const td4 = document.createElement('td');
        td4.textContent = '=';
        tr.appendChild(td4);

        // Create and append the fifth cell (product price * quantity)
        const td5 = document.createElement('td');
        td5.textContent = (product.price * displayedQuantity).toFixed(2);
        tr.appendChild(td5);

        // Append the row to the table
        table.appendChild(tr);

        // Append the table to the list item
        li.appendChild(table);

        // Append the list item to the cart items element
        cartItemsElement.appendChild(li);

        // Calculate the total cost
        totalCost += product.price * displayedQuantity;
    });

    // Update the total cost display
    totalElement.textContent = totalCost.toFixed(2);
}


// Helper function to get the input element id for a given product name
function getInputId(productName) {
    return productName.toLowerCase();
}

function capFrstLtr(string) {
    return string.replace(/\b\w/g, match => match.toUpperCase());
}

// Helper function to get product details by name
function getProductByName(productName) {
    return productName.toLowerCase() === 'organic sugar' ? { name: 'Organic Sugar', price: 100 } :
        productName.toLowerCase() === 'brown sugar' ? { name: 'Brown Sugar', price: 75 } :
            productName.toLowerCase() === 'white sugar' ? { name: 'White Sugar', price: 50 } :
                productName.toLowerCase() === 'liquid sugar' ? { name: 'Liquid Sugar', price: 45 } :
                    { name: '', price: 0 };
}
// Your JavaScript code

function checkout() {
    // Check if the cart is empty
    if (cartItems.length === 0) {
        var CartalertDiv = document.getElementById('CartalertDiv');
        CartalertDiv.style.display = "block";
        if (CartalertDiv.style.display == 'block') {
            setTimeout(function () {
                window.location.href = 'shopIndex.php';
            }, 2000);
        }

    } else {


        // Creating a form element
        var form = document.createElement('form');
        form.id = 'checkoutForm';
        form.style.display = 'none';
        form.method = 'post';
        form.action = 'cartToDatabase.php';

        // Loop through the cart items and add input fields for each item
        cartItems.forEach(item => {
            const product = getProductByName(item.pName);


            var productNameInput = document.createElement('input');
            productNameInput.type = 'text';
            productNameInput.name = 'pro_name[]'; // Use an array to handle multiple items
            productNameInput.value = product.name;
            form.appendChild(productNameInput);

            // Product Price Input
            var productPriceInput = document.createElement('input');
            productPriceInput.type = 'text';
            productPriceInput.name = 'pro_price[]';
            productPriceInput.value = product.price.toFixed(2); // Use toFixed(2) to ensure two decimal places
            form.appendChild(productPriceInput);


            // Product Quantity Input (just once for the total quantity)
            var productQuantityInput = document.createElement('input');
            productQuantityInput.type = 'text';
            productQuantityInput.name = 'pro_quantity[]';
            productQuantityInput.value = item.quantity.toString();
            form.appendChild(productQuantityInput);
        });


        document.body.appendChild(form);


        form.submit();
    }
}
document.addEventListener('DOMContentLoaded', function () {
    var qntyElements = document.querySelectorAll('.qnty');

    qntyElements.forEach(function (qntyElement) {
        qntyElement.addEventListener('click', function (e) {
            var target = e.target;
            var input = null;

            if (target.classList.contains('plus')) {
                input = target.previousElementSibling;
            } else if (target.classList.contains('minus')) {
                input = target.nextElementSibling;
            }

            if (input) {
                var value = parseInt(input.value);
                if (isNaN(value)) {
                    value = 0;
                }
                if (!isNaN(value)) {
                    if (target.classList.contains('plus')) {
                        input.value = value + 1;
                    } else if (target.classList.contains('minus') && value > 0) {
                        if (value > 1) {
                            input.value = value - 1;
                        }
                    }
                    input.dispatchEvent(new Event('change'));
                }
            }
        });
    });

});



// Final Checkout Error Handler



function finalCheckout() {
    var total = document.getElementById("total");
    if (total.innerHTML === "0.00") {

        //Php file 

        var CartalertDiv = document.getElementById('CartalertDiv');
        CartalertDiv.style.display = "block";
        if (CartalertDiv.style.display == 'block') {
            setTimeout(function () {
                window.location.href = 'checkout.php';
            }, 2000);
        }


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
            var AddressalertDiv = document.getElementById('AddressalertDiv');
            AddressalertDiv.style.display = "block";
            if (AddressalertDiv.style.display == 'block') {
                setTimeout(function () {
                    window.location.href = 'checkout.php';
                }, 2000);
            }
        }
    }


}
