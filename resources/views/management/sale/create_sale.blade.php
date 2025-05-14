<!DOCTYPE html>
<?php 
    // Fetch products from the database
    use Illuminate\Support\Facades\DB;
    $products = DB::table('products')->get();
    
?>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')
    <head> <meta name="csrf-token" content="{{ csrf_token() }}"> </head>

    <body>
    @auth
    @include('reusable.navbar')
    <main class="container">
        <h1>Sale Management</h1>
        <p>Welcome to the Sale Management page!</p>
        <p>Here you can manage your sales effectively.</p>
        
        <!-- Add your sale management content here -->
        <h2>Create Sale</h2>
        <section>
            <article class='receipt'>
                <h3>Receipt</h3>
                <div id='receipt-content'>
                    <!-- Receipt content will be dynamically added here -->

                </div>
                <button class='print-button' id='print-button'>Print Receipt</button>
            </article >
            <article id='Transaction'>
                <h3>Available Products</h3>
                <div id='row'>
                    @foreach($products as $product)
                    <div class='col-md-3'>
                        <div class='product-card' data-id='{{ $product->ID }}' data-name='{{ $product->ProductName }}' data-price='{{ $product->UnitPrice }}' data-quantity='{{ $product->UnitsInStock }}'>
                            <span>{{ $product->ProductName }}</span>
                            <span>{{ $product->UnitPrice }}</span>
                            <span>{{ $product->UnitsInStock }}</span>
                            <button class='add-to-cart'>Add to Cart</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <h3>Cart</h3>
                <table id='cart'>
                    <thead>
                        <tr>
                            <th>Product Name</th><th>Price</th><th>Quantity</th><th>Total Price</th><th>Action</th>
                        </tr>
                    </thead>
                    <tbody id='cart-items'>
                        <!-- Cart items will be dynamically added here -->

                        
                    </tbody>
                </table>
                <label for='cart-total'>Total: </label>
                <input type='number' id='cart-total' value='0' readonly step='0.01' /></br>

                <form id='checkout-form'>
                    @csrf
                    <button class='submit-button' id='submit-button'>Checkout</button>
                </form>
            </article>
        </section>
        
        <a href="/" class="btn btn-primary">Back to Home</a>
    </main>
    @else
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>

