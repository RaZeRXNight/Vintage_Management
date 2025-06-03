@php
    use Illuminate\Support\Facades\DB;
    use App\Models\Transaction;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('reusable.head')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class=''>
    @auth
        @include('reusable.navbar')
        <main class="w-full min-h-fit bg-amber-50 p-10 text-center flex flex-row justify-around ">
            <!-- Add your sale management content here -->
                <article class='flex flex-col justify-center w-80 rounded bg-gray-50 min-w-2/10 px-6 pt-8 shadow-lg '>
                    <div class='flex flex-col justify-center items-center justify-self-start gap-2'>
                        <h2 class='text-center'>Receipt</h2>
                        <h3 class='text-center'>Business Name</h3>
                        <p class="text-xs">The Address of the Location</p>
                    </div>

                    <div class=" border-b border border-dashed"></div>

                    <div class='flex flex-col gap-3 border-b py-6 text-xs'>
                        <span id='receiptid'>Receipt Number:
                            @php 
                            if ($Entry = Transaction::get()->sortByDesc('TransactionID')->first()) {
                                echo $Entry->TransactionID + 1;
                            }  else { echo 1; }
                            @endphp 
                        </span>
                        <span id='UserID'>Cashier ID: @php   echo Auth::id(); @endphp </span>
                        <span class="text-xs" id='UserName'>Cashier: @php    echo Auth::user()->name; @endphp </span>
                        <span class="text-xs" id='date'> @php echo date('Y-m-d H:i:s') @endphp </span>
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

                    <div class='flex flex-col gap-3 border-b py-6 text-xs text-center justify-self-end' id='receipt-footer'>
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

                <article class='border-2 divide-y-2 min-w-6/10 min-h-max p-10 rounded-2xl shadow-2xl outline-1 backdrop-blur-2xl' id='Transaction'>
                    <h3 class='text-center text-lg text-shadow-xs'>Available Products</h3>
                    <div class='flex flex-col gap-5 min-w-max items-center rounded-2xl shadow-2xl outline-1 backdrop-blur-2xl p-10' id='row'>
                        
                        @php
                            // Fetch products from the database
                            $products = DB::table('products')->get();
                            $productsperpage = 20;
                            $productsperrow = 5;
                            $row = $productsperpage / $productsperrow;
                            $page = 1;
                            $count = 0;
                            $category = null;
                        @endphp

                        <div class='scroll-auto rounded-2xl shadow-2xl outline-1 backdrop-blur-2xl min-w-9/10 flex flex-col gap-1 p-5 items-center'>
                        @foreach($products as $product)
                            @if($count % $productsperrow == 0)
                                <div class='flex flex-row justify-center max-h-45 border rounded min-w-full max-w-full '>
                            @endif
                                <div class='flex flex-col justify-end min-h-fit max-w-50 min-w-fit product-card' data-id='{{ $product->ID }}'
                                    data-name='{{ $product->ProductName }}' data-price='{{ $product->UnitPrice }}'
                                    data-quantity='{{ $product->UnitsInStock }}'>

                                    <button class='add-to-cart'>
                                        <img class='rounded-t-2xl max-h-30' 
                                            id='product-img-{{ $product->ID }}'
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
                                @php $count++; @endphp
                                @if($count % $productsperrow == 0)
                                    </div>
                                @endif
                        @endforeach
                        </div>
                    </div>

                    <div class='flex flex-col gap-2 border self-center text-center min-w-9/10 min-h-20 max-w-9/10 p-5 pb-10 rounded-2xl shadow-2xl outline-1 backdrop-blur-2xl'>
                        <h3 class='text-lg'>Cart</h3>

                        <div class='flex flex-row border min-w-9/10 min-h-25 max-w-9/10 self-center' id='cart-items'>
                            <!-- Cart items will be dynamically added here -->


                        </div>

                        <div class='border min-w-9/10 max-w-9/10 self-center'>
                            <label for='cart-total'>Total: </label>
                            <input class='text-center' type='number' id='cart-total' value='0' readonly step='0.01' />
                        </div>
                    </div>
                </article>
        </main>
        @include('reusable.footer')
    @else
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
</body>

</html>