// Cart functionality
// This code handles the cart functionality, including adding items to the cart, removing items, and updating the total price.;

document.addEventListener('DOMContentLoaded', () => {
    const cart = [];
    const cartItems = document.getElementById('cart-items');
    const receiptItems = document.getElementById('receipt-items');
    const cartTotal = document.getElementById('cart-total');
    const receiptTotal = document.getElementById('receipt-total');
    const cartAmount = document.getElementById('cart-amount');
    const receiptAmount = document.getElementById('receipt-amount');

    const PayMethod = document.getElementById('PaymentMethod');
    let Payselected = null;


    const checkoutForm = document.getElementById('checkout-form');
    const submitButton = document.getElementById('submit-button');
    if (!cartItems || !checkoutForm) {
        return;
    }

    const userID = document.getElementById('UserID').textContent;
    // Event Listeners for add to cart buttons
    document.getElementById('cart-product-items').addEventListener('click', function(event) {
        const btn = event.target.closest('.add-to-cart');
        if (btn) {
            const productRow = btn.closest('.product-card');
            const productId = productRow.dataset.id;
            const productName = productRow.dataset.name;
            const productPrice = parseFloat(productRow.dataset.price);

            // Check if product is already in cart
            // Add to the total Quantity if another is found
            const existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.quantity += 1;
                existingProduct.total = existingProduct.productPrice * existingProduct.quantity;
            } else {
                cart.push({ id: productId, productName: productName, productPrice: productPrice, quantity: 1, total: productPrice });
            }
            updateCart();
        };
    });

    function updateCart() {
        // Lays out a foundation for listItems to be created and displayed, 
        // This location is on the Indicated ID on the Created HTML Page.
        // Current Cart Items
        cartItems.innerHTML = '';
        receiptItems.innerHTML = '';
        let total = 0;
        cart.forEach(item => {
            let productName = item.productName;
            const imgElement = document.getElementById('product-img-' + item.id);
            const listImage = imgElement ? imgElement.src : '';
            // Creates an Element under the Variable listItems within CartItems.

            const listItem = document.createElement('div');
            listItem.className = 'product-card';
            listItem.innerHTML = '<button class="remove-from-cart" id=' + item.id + '>' +
                '<img src=' + listImage + ' alt="Product Image" /> ' +
                '</button>' + '<div class="flex flex-col max-w-full border divide-x-1 text-center">' +
                '<span>' + productName + '</span></div>' +
                '<div class="flex flex-row justify-around max-w-full border"><span>' + item.quantity + '</span>' +
                '<span>$' + item.total.toFixed(2) + '</span></div>';

            // listItem.innerHTML = `<td>${item.productName}</td>
            // <td>$${item.productPrice}</td>
            // <td>${item.quantity}</td><td>$${item.total.toFixed(2)}</td>
            // <td><button class="remove-from-cart" data-id="${item.id}">Remove</button></td>`;

            // <td>${item.productName}</td>
            // <td>$${item.productPrice}</td>
            // <td>${item.quantity}</td><td>$${item.total.toFixed(2)}</td>';

            // product-card' data-id='{{ $product->ID }}'
            //     data-name='{{ $product->ProductName }}' data-price='{{ $product->UnitPrice }}'
            //     data-quantity='{{ $product->UnitsInStock }}'>

            //     <div class='flex flex-col max-w-full border divide-x-1 text-center'>
            //         <div class='max-w-full border text-center'>
            //             <span>{{ $product->ProductName }}</span>
            //         </div>

            //         <div class='flex flex-row justify-around max-w-full border'>
            //             <span>${{ $product->UnitPrice }}</span>
            //             <span>{{ $product->UnitsInStock }}</span>
            //         </div>
            //     </div>
            // </div>

            total += item.total;
            // Adds the listItem to the CartItems variable.
            // This is where the listItem is displayed on the HTML page.
            cartItems.appendChild(listItem);

            const receiptlistItem = document.createElement('tr');
            receiptlistItem.innerHTML = `<td>$${item.total.toFixed(2)}</td><td>${item.productName}</td><td>${item.quantity}</td>`;
            receiptItems.appendChild(receiptlistItem);
        });
        // Updates the total price

        cartTotal.value = `${total.toFixed(2)}`;
        receiptTotal.value = `${total.toFixed(2)}`;
    }
    // Event Listener for remove from cart buttons
    cartItems.addEventListener('click', (event) => {
        const removeBtn = event.target.closest('.remove-from-cart');
        if (removeBtn) {

            const productId = removeBtn.id;
            const productIndex = cart.findIndex(item => item.id === productId);

            if (productIndex > -1) {
                if (cart[productIndex].quantity > 1) {
                    cart[productIndex].quantity -= 1;
                    cart[productIndex].total = cart[productIndex].productPrice * cart[productIndex].quantity;
                } else {
                    // Remove product from cart if quantity is 1
                    cart.splice(productIndex, 1);
                }
                updateCart();
            }
        }
    });

    PayMethod.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', (event) => {
            if (Payselected === button.textContent) {
                alert('You already Selected This.');
            } else {
                Payselected = button.textContent;
            };

        })
    });

    submitButton.addEventListener('click', (event) => {
        if (cart.length === 0) {
            event.preventDefault();
            alert('Your cart is empty. Please add items to your cart before checking out.');
        } else {
            // Here you can handle the form submission, e.g., send cart data to the server
            event.preventDefault();

            // A Form is Quickly Created and Sent.
            checkoutForm.action = '/sale_management/create_sale';
            checkoutForm.method = 'POST';

            const userinput = document.createElement('input');
            userinput.name = 'userID';
            userinput.type = 'hidden';
            userinput.value = userID;
            checkoutForm.appendChild(userinput);

            cart.forEach(item => {
                // Creates an Element under the Variable listItems within CartItems.
                const inputlist = document.createElement('input');
                inputlist.type = 'hidden';
                inputlist.name = 'cart[]';
                inputlist.value = JSON.stringify(item);
                checkoutForm.appendChild(inputlist);
            });

            const PaymentMethod = document.createElement('input');
            PaymentMethod.type = 'hidden';
            PaymentMethod.name = 'PaymentMethod';
            PaymentMethod.value = Payselected;
            checkoutForm.appendChild(PaymentMethod);

            checkoutForm.submit();
            // Optionally, you can redirect the user to a confirmation page or show a success message
            // window.location.href = '/';
        }
    });

});
