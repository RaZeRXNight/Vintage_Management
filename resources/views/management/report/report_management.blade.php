<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('reusable.head')

<body class='flex flex-col min-h-screen'>
    @auth
        @include('reusable.navbar')
        <form id='Hidden-Stash' hidden>
            <input type='hidden' id='products-data' value='@json($Product)'>
            <input type='hidden' id='transactions-data' value='@json($Transaction)'>
            <input type='hidden' id='sales-data' value='@json($Sale)'>
        </form>

        <main class='container min-w-9/10 self-center'>
            <section class='self-center text-center'>
                <h1>Report Management</h1>
            </section>

            <section class='flex flex-row justify-start gap-10 p-10 border-2 border-gray-300 rounded-lg bg-white shadow-md'>
                <div id='Report_Buttons' class='flex flex-col gap-5 border-r-2 pr-10 min-h-9/10 min-w-fit'>
                    <div id='Sales_Reports'  class='flex flex-col gap-3 text-center border border-gray-300 rounded-lg bg-white shadow-md p-2'>
                        <h2 class='border-b-2'>Sales Reports</h2>
                        <button id='Today_Sales'>Today's Sales Report</button>
                        <button id='Weekly_Sales'>Weekly Sales Report</button>
                        <button id='Monthly_Sales'>Monthly Sales Report</button>
                        <button id='Annual_Sales'>Annual Sales Report</button>
                    </div>

                    <div id='Product_Reports' class='flex flex-col gap-3 text-center border border-gray-300 rounded-lg bg-white shadow-md p-2'>
                        <h2 class='border-b-2'>Product Reports</h2>
                        <button id='Most_Sold_Products' data-type='Products' data-start-date='' data-end-date=''>Most Sold Products</button>
                        <button id='Least_Sold_Products' data-type='Products' data-start-date='' data-end-date=''>Least Sold Products</button>
                        <button id='Top_Products' data-type='Products' data-start-date='' data-end-date=''>Top Products</button>
                        <button id='Low_Stock_Products' data-type='Products' data-start-date='' data-end-date=''>Low Stock Products</button>
                    </div>
                </div>

                <div id='Report_Container' class='flex flex-col gap-5 w-full'>
                    <div id='Report_Content' class='flex flex-col gap-5'>
                        <p class='text-center'>Select a report from the left sidebar to view details.</p>
                    </div>

                    <div id='Report_Filters' class='flex flex-row justify-between'>
                        <div class='flex flex-col'>
                            <label for='Start_Date'>Start Date:</label>
                            <input type='date' id='Start_Date' name='Start_Date'>
                        </div>
                        <div class='flex flex-col justify-items-center'>
                            <label class='text-center' for='Search'>Search</label>
                            <input class='text-center' type='text' id='Search' name='Search' placeholder='Search by Item Name or ID'>
                        </div>

                        <div class='flex flex-col'>
                            <label for='End_Date'>End Date:</label>
                            <input id='End_Date' type='date'  name='End_Date'>
                        </div>
                    </div>

                    <table id='Report_Table' class='list-table'>
                        <!-- Dynamic content will be inserted here -->
                    </table>
                </div>
            </section>

            {{-- <section class='flex flex-col text-center'>
                <!-- Row 1: Product Sales -->
                <h2>Sales Reports</h2>
                <div class='flex flex-row justify-around border'>
                    <div class=''>
                        <h3>Sales This Week</h3>
                        <table class='list-table'>
                            <thead>
                                <th>TransactionID</th> <th>Quantity</th> <th>Total Price</th> <th>Payment Method</th> <th>Transaction Date</th>
                            </thead>    
                            <tbody>
                            @foreach($transactions as $transaction)
                                @if($transaction->created_at->format('W') == now()->format('W') and $transaction->created_at->format('Y') == now()->format('Y'))
                                <tr>
                                    <td><a href="/sale_management/view_transaction/{{ $transaction->id }}">{{$transaction->id}}</a></td>
                                    <td>{{$transaction->Quantity}}</td>
                                    <td>{{$transaction->TotalPrice}}</td>
                                    <td>{{$transaction->PaymentMethod}}</td>
                                    <td>{{$transaction->created_at->format('d M')}}</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class='border-x-2'></div>

                    <div class=''>
                        <h3 class='text-center'>Sales This Month</h3>
                        <table class='list-table'>
                            <thead>
                                <th>TransactionID</th> <th>Quantity</th> <th>Total Price</th> <th>Payment Method</th> <th>Transaction Date</th>
                            </thead>    
                            <tbody>
                            @foreach($transactions as $transaction)
                                @if($transaction->created_at->format('M') == now()->format('M') and $transaction->created_at->format('Y') == now()->format('Y'))
                                <tr>
                                    <td>{{$transaction->TransactionID}}</td>
                                    <td>{{$transaction->Quantity}}</td>
                                    <td>{{$transaction->TotalPrice}}</td>
                                    <td>{{$transaction->PaymentMethod}}</td>
                                    <td>{{$transaction->created_at->format('d M')}}</td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Row 2: Product Sales High/Slows -->
                <h2>Sold Products Reports</h2>
                <div class='flex flex-row justify-around gap-10'>
                    <div>
                        <h3>Most Sold Products</h3>
                    </div>

                    <div>
                        <h3>Least Sold Products</h3>
                    </div>
                </div>
            </section> --}}
        </main>

        @include('reusable.footer')
    @else
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="{{ route('/') }}">login</a> to access your account.</p>
    @endauth

</body>

</html>