<!DOCTYPE html>
<?php 
    // Fetch products from the database
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
$products = DB::table('products')->get();
?>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('reusable.head')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @auth
        @include('reusable.navbar')
        <main class="text-center">
            <div class='m-10'>
                <h1>Sale Management</h1>
                <p>Welcome to the Sale Management page!</p>
                <p>Here you can manage your sales effectively.</p>
            </div>
            <!-- Add your sale management content here -->

            <section class='flex flex-row justify-around'>
                <article class='w-80 rounded bg-gray-50 px-6 pt-8 shadow-lg'>
                    <h2 class='text-center'>Receipt</h2>
                    <div class='flex flex-col justify-center items-center gap-2'>
                        <h3 class='text-center'>Business Name</h3>
                        <p class="text-xs">The Address of the Location</p>
                    </div>

                    <div class=" border-b border border-dashed"></div>

                    <div class='flex flex-col gap-3 border-b py-6 text-xs'>
                        <span id='receiptid'>Receipt Number:
                            <?php    $Entry = Transaction::get()->sortByDesc('TransactionID')->first();
                                     echo $Entry->TransactionID + 1; ?></span>
                        <span id='UserID'>Cashier ID: <?php    echo Auth::id(); ?></span>
                        <span class="text-xs" id='UserName'>Cashier: <?php    echo Auth::user()->name; ?></span>
                        <span class="text-xs" id='date'> <?php    echo now() ?></span>
                    </div>

                    <div class='flex flex-col gap-3 pb-6 pt-2 text-xs min-h-[20vh]' id='receipt-content'>
                        <!-- Receipt content will be dynamically added here -->
                        <table class='w-full text-left min-h-100h'>
                            <thead>
                                <tr>
                                    <th>Price</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody id='receipt-items'>
                                <!-- Cart items will be dynamically added here -->

                            </tbody>
                        </table>
                    </div>

                    <div class="border-b border border-dashed"></div>

                    <div class='flex flex-col gap-3 border-b py-6 text-xs text-center' id='receipt-footer'>
                        <p> Total: <input class='text-right min-w-10 max-w-15' type='number' id='receipt-total' value='0'
                                readonly step='0.01' /> </p>

                        <div class='flex flex-row gap-3 justify-around' id='PaymentMethod'>
                            <button class='min-w-fit' id='cash'>Cash</button>
                            <button class='min-w-fit' id='card'>Card</button>
                        </div>

                        <form id='checkout-form'> @csrf <button id='submit-button'>Checkout</button> </form>

                        <button class='print-button' id='print-button'>Print Receipt</button>
                    </div>
                </article>

                <article class='border-2 divide-y-2 justify-center' id='Transaction'>
                    <div class='flex flex-col gap-5 min-w-max' id='row'>
                        <h3 class='text-center text-lg text-shadow-xs'>Available Products</h3>
                        @php
                            $productsperpage = 20;
                            $productsperrow = 5;
                            $row = $productsperpage / $productsperrow;
                            $page = 1;
                            $count = 0;
                            $category = null;
                        @endphp

                        @foreach($products as $product)
                            @if($count % $productsperrow == 0)
                                <div class='flex flex-row justify-center max-h-75 border rounded'>
                            @endif
                                <div class='flex flex-col justify-end min-h-50 max-w-50'>
                                    <div class='min-w-fit product-card' data-id='{{ $product->ID }}'
                                        data-name='{{ $product->ProductName }}' data-price='{{ $product->UnitPrice }}'
                                        data-quantity='{{ $product->UnitsInStock }}'>

                                        <button class='add-to-cart'>
                                            <img class='rounded-t-2xl max-w-50 max-h-50 '
                                            src='{{ asset('storage/' . $product->ProductIMG) }}'
                                            alt='Product Image' />
                                        </button>

                                        <div class='flex flex-col max-w-full border divide-x-1 text-center'>
                                            <div class='max-w-full border text-center'>
                                                <span>{{ $product->ProductName }}</span>
                                            </div>

                                            <div class='flex flex-row justify-around max-w-full border'>
                                                <span>${{ $product->UnitPrice }}</span>
                                                <span>{{ $product->UnitsInStock }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php $count++; @endphp
                                @if($count % $productsperrow == 0)
                                    </div>
                                @endif
                        @endforeach
                    </div>

                    <div class='self-center text-center flex flex-col items-center'>
                        <h3 class='text-lg'>Cart</h3>
                        <table class='border' id='cart'>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id='cart-items'>
                                <!-- Cart items will be dynamically added here -->


                            </tbody>
                        </table>
                        <div>
                            <label for='cart-total'>Total: </label>
                            <input class='text-center' type='number' id='cart-total' value='0' readonly step='0.01' />
                        </div>
                    </div>
                </article>
            </section>
        </main>
    @else
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="/">login</a> to access your account.</p>
    @endauth

</body>

</html>