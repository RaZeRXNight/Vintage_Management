@php
    use Illuminate\Support\Facades\DB;
    use App\Models\Transaction;
    use App\Models\Categorie;

    // Fetch products from the database
    $products = DB::table('products')->get();
    $Categories = Categorie::all();
@endphp

<form id='Hidden-Stash' hidden>
    <input type='hidden' id='products-data' value='@json($products)'>
</form>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('reusable.head')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>
    @auth
        @include('reusable.navbar')
        <main class="flex flex-row justify-around w-full min-h-fit outline-2 p-10 text-center">
            <!-- Add your sale management content here -->

            <article class='cart' id='Transaction'>
                <section class='cart-header min-w-9/10'>
                    <h3 class='text-center text-lg text-shadow-xs'>Available Products</h3>

                    <div class='flex flex-row justify-center items-center gap-5'>
                        <h2 id='Current_Filter'>Showing All</h2>
                        <input id='Search' type='text' placeholder='Search for Product'>
                    </div>

                    <div class='flex flex-row justify-around gap-5' id='Category-items'>
                        <!-- Product rows will be populated here -->
                        <button data-id=0>All</button>
                        @foreach ($Categories as $Category => $details)
                            <button data-id={{ $details->id }}>{{ $details->CategoryName }}</button>
                        @endforeach
                    </div>
                </section>

                <section class='rounded-2xl shadow-2xl outline-1 backdrop-blur-2xl p-5 min-w-fit' >
                    <div class='min-w-9/10 flex flex-col gap-2 p-5 items-center'
                        id='cart-product-items'>
                        <!-- Product Items wil be added Dynamically Here. -->
                    </div>

                    <div class='pagination-controls' id='pagination-controls'>
                        
                    </div>
                </section>

                <section class='cart-footer'>
                    <h3 class='text-lg'>Cart</h3>

                    <div class='flex flex-row border min-w-9/10 min-h-25 max-w-9/10 self-center p-1' id='cart-items'>
                        <!-- Cart items will be dynamically added here -->
                    </div>

                    <div class='border min-w-9/10 max-w-9/10 self-center p-2'>
                        <label for='cart-total'>Total: </label>
                        <input class='text-center' type='number' id='cart-total' value='0' readonly step='0.01' />

                        <div class='flex flex-row gap-3 justify-around' id='PaymentMethod'>
                            <button class='min-w-fit' id='cash'>Cash</button>
                            <button class='min-w-fit' id='card'>Card</button>
                        </div>

                        <form class='max-w-9/10 justify-self-center' id='checkout-form'> @csrf <button id='submit-button'>Checkout</button> </form>
                    </div>
                </section>
            </article>

            <article class='flex flex-col justify-start w-80 rounded bg-gray-50 min-w-2/10 max-h-fit px-6 pt-8 shadow-lg '>
                <div class='flex flex-col justify-center items-center justify-self-start gap-2'>
                    <h2 class='text-center'>Receipt</h2>
                    <h3 class='text-center'>Business Name</h3>
                    <p class="text-xs">The Address of the Location</p>
                </div>

                <div class="border-b border border-dashed">

                </div>

                <div class='flex flex-col gap-3 border-b py-6 text-xs'>
                    <span id='receiptid'>Receipt Number:
                        @php
                            if ($Entry = Transaction::get()->sortByDesc('TransactionID')->first()) {
                                echo $Entry->TransactionID + 1;
                            } else {
                                echo 1;
                            }
                        @endphp
                    </span>
                    <span id='UserID'>Cashier ID: @php echo Auth::id(); @endphp </span>
                    <span class="text-xs" id='UserName'>Cashier: @php echo Auth::user()->name; @endphp </span>
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

                    <button class='print-button' id='print-button'>Print Receipt</button>
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