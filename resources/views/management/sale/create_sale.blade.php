<!DOCTYPE html>
<?php 
    // Fetch products from the database
    use Illuminate\Support\Facades\DB;
    use App\Models\Transaction;
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
        <section class='flex justify-evenly'>
            <article class='w-80 rounded bg-gray-50 px-6 pt-8 shadow-lg'>
                <div class='flex flex-col justify-center items-center gap-2'>
                    <h3 class='text-center'>Business Name</h3>
                    <p class="text-xs">The Address of the Location</p>
                </div>

                <div class=" border-b border border-dashed"></div>

                <div class='flex flex-col gap-3 border-b py-6 text-xs'>
                    <span id='receiptid'>Receipt Number: <?php $Entry = Transaction::get()->sortByDesc('TransactionID')->first(); echo $Entry->TransactionID+1; ?></span>
                    <span  id='UserID'>Cashier ID: <?php echo Auth::id(); ?></span>
                    <span class="text-xs" id='UserName'>Cashier: <?php echo Auth::user()->name; ?></span>
                    <span class="text-xs" id='date'> <?php echo now() ?></span>
                </div>

                <div class='flex flex-col gap-3 pb-6 pt-2 text-xs min-h-[20vh]' id='receipt-content'>
                    <!-- Receipt content will be dynamically added here -->
                    <table class='w-full text-left min-h-100h'>
                        <thead>
                            <tr>
                                <th>Price</th><th>Product Name</th><th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id='receipt-items'>
                            <!-- Cart items will be dynamically added here -->
                            
                        </tbody>
                    </table>
                </div>

                <div class="border-b border border-dashed"></div>

                <div class='flex flex-col gap-3 border-b py-6 text-xs text-center' id='receipt-footer'>
                    <p> Total: <input class='text-right min-w-10 max-w-15' type='number' id='receipt-total' value='0' readonly step='0.01' /> </p>

                    <div class='flex flex-row gap-3 justify-around' id='PaymentMethod'>
                        <button class='min-w-fit' id='cash'>Cash</button>
                        <button class='min-w-fit' id='card'>Card</button>
                    </div>

                    <form id='checkout-form'> @csrf <button id='submit-button'>Checkout</button> </form>

                    <button class='print-button' id='print-button'>Print Receipt</button>
                </div>
            </article>

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

