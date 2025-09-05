<?php 
use app\Models\Transaction;
use app\Models\Sale;
use App\Models\Product;

$total = null;
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('reusable.head')

<body>
    @auth
        @include('reusable.navbar')

        <main class='centered_main container min-w-full mt-auto'>
            <section class='flex justify-evenly'>
                <article class='justify-self-center w-80 rounded bg-gray-50 px-6 pt-8 shadow-lg'>
                    <div class='flex flex-col justify-center items-center gap-2'>
                        <h3 class='text-center'>Business Name</h3>
                        <p class="text-xs">The Address of the Location</p>
                    </div>

                    <div class=" border-b border border-dashed"></div>

                    <div class='flex flex-col gap-3 border-b py-6 text-xs'>
                        <span id='receiptid'>Receipt Number:
                            <?php echo $transaction->id; ?></span>
                        <span id='UserID'>Cashier ID: <?php    echo Auth::id(); ?></span>
                        <span class="text-xs" id='UserName'>Cashier: <?php    echo Auth::user()->name; ?></span>
                        <span class="text-xs" id='date'> <?php echo $transaction->TransactionDate;  ?></span>
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
                                @foreach($Sales as $sale) 
                                <tr>  <?php  $total+=$sale->TotalPrice; ?>
                                    <td>{{ $sale->TotalPrice }}</td>
                                    <td>
                                        <?php 
                                            echo Product::where('id', $sale->ProductID)
                                            ->firstOrFail()->ProductName; 
                                        ?>
                                    </td>
                                    <td>{{$sale->Quantity}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="border-b border border-dashed"></div>

                    <div class='flex flex-col gap-3 border-b py-6 text-xs text-center' id='receipt-footer'>
                        <p> Total: <input class='text-right min-w-10 max-w-15' type='number' id='receipt-total' value={{ $total }}
                                readonly step='0.01' /> </p>

                        <button class='print-button' id='print-button'>Print Receipt</button>
                    </div>
                </article>

                <article class='flex flex-col justify-around text-center'>
                    <table class='min-w-auto' id='transaction'>
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Transaction ID</th>
                                <th class="py-2 px-4 border-b">User ID</th>
                                <th class="py-2 px-4 border-b">Quantity</th>
                                <th class="py-2 px-4 border-b">Total Price</th>
                                <th class="py-2 px-4 border-b">Payment Method</th>
                                <th class="py-2 px-4 border-b">Transaction Status</th>
                                <th class="py-2 px-4 border-b">Transaction Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $transaction->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $transaction->UserID }}</td>
                                <td class="py-2 px-4 border-b">{{ $transaction->Quantity }}</td>
                                <td class="py-2 px-4 border-b">${{ $transaction->TotalPrice }}</td>
                                <td class="py-2 px-4 border-b">{{ $transaction->PaymentMethod }}</td>
                                <td class="py-2 px-4 border-b">{{ $transaction->TransactionStatus }}</td>
                                <td class="py-2 px-4 border-b">{{ $transaction->TransactionDate }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class='min-w-full' id='sales'>
                        <thead>
                            <th class="py-2 px-4 border-b">Sale ID</th>
                            <th class="py-2 px-4 border-b">Product Name</th>
                            <th class="py-2 px-4 border-b">Quantity</th>
                            <th class="py-2 px-4 border-b">Individual Price</th>
                            <th class="py-2 px-4 border-b">Total Price</th>
                        </thead>
                        <tbody>
                            @foreach($Sales as $sale)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $sale->id }}</td>
                                    <td class="py-2 px-4 border-b"><?php echo Product::where('id', $sale->ProductID)->first()->ProductName; ?></td>
                                    <td class="py-2 px-4 border-b">{{$sale->Quantity}}</td>
                                    <td class="py-2 px-4 border-b"><?php echo '$'.Product::where('id', $sale->ProductID)->first()->UnitPrice; ?></td>
                                    <td class="py-2 px-4 border-b">${{ $sale->TotalPrice }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </article>
            </section>
        </main>


    @else
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="/">login</a> to access your account.</p>
    @endauth

</body>

</html>