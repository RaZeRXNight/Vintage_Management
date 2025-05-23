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
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', (event) => {
            console.log('Add to cart button clicked');
            const productRow = event.target.closest('.product-card');
            const productId = productRow.dataset.id;
            const productName = productRow.dataset.name;
            const productPrice = parseFloat(productRow.dataset.price);

            // Check if product is already in cart
            // Add to the total Quantity if another is found
            const existingProduct = cart.find(item => item.id === productId);
            if (existingProduct) {
                existingProduct.quantity += 1;
                existingProduct.total = existingProduct.productPrice * existingProduct.quantity;
                console.log('Product already in cart:', existingProduct.productName);
                console.log('Updated quantity:', existingProduct.quantity);
                console.log('Product total:', existingProduct.total);
            } else {
                cart.push({ id: productId, productName: productName, productPrice: productPrice, quantity: 1, total: productPrice });
                console.log('Product added to cart:');
                console.log('Product ID:', productId);
                console.log('Product name:', productName);
                console.log('Product price:', productPrice);
            }
            updateCart();
        });
    });

    function updateCart() {
        // Lays out a foundation for listItems to be created and displayed, 
        // This location is on the Indicated ID on the Created HTML Page.
        console.log('Updating cart...');
        // Current Cart Items
        console.log(JSON.stringify(cart, null, 4));
        cartItems.innerHTML = ''; 
        receiptItems.innerHTML = ''; 
        let total = 0;
        cart.forEach(item => {
            // Creates an Element under the Variable listItems within CartItems.
            const listItem = document.createElement('tr');
            listItem.innerHTML = `<td>${item.productName}</td><td>$${item.productPrice}</td>
            <td>${item.quantity}</td><td>$${item.total.toFixed(2)}</td>
            <td><button class="remove-from-cart" data-id="${item.id}">Remove</button></td>`;
            total += item.total;
            // Adds the listItem to the CartItems variable.
            // This is where the listItem is displayed on the HTML page.
            cartItems.appendChild(listItem);

            const receiptlistItem = document.createElement('tr');
            receiptlistItem.innerHTML = `<td>$${item.total.toFixed(2)}</td><td>${item.productName}</td><td>${item.quantity}</td>`;
            receiptItems.appendChild(receiptlistItem);
        });
        // Updates the total price
            
        console.log('Total:', total);
        cartTotal.value = `${total.toFixed(2)}`;
        receiptTotal.value = `${total.toFixed(2)}`;
    }
    // Event Listener for remove from cart buttons
    cartItems.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-from-cart')) {
            const productId = event.target.dataset.id;
            const productIndex = cart.findIndex(item => item.id === productId);
            if (productIndex > -1 ) {
                if (cart[productIndex].quantity > 1) {
                    cart[productIndex].quantity -= 1;
                    cart[productIndex].total = cart[productIndex].productPrice * cart[productIndex].quantity;
                    console.log('Product quantity updated:', productId);
                } else {
                    // Remove product from cart if quantity is 1
                    cart.splice(productIndex, 1);
                    console.log('Product quantity is 1, removing from cart:', productId);
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
                inputlist.type ='hidden';
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
            console.log('Cart data sent to server:', cart);
            // Optionally, you can redirect the user to a confirmation page or show a success message
            // window.location.href = '/';
        }
        console.log('Form submitted with cart:', cart);
    });
    
});
