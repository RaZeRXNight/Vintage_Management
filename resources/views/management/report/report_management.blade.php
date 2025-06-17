<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('reusable.head')

<body class='flex flex-col min-h-screen'>
    @auth
        @include('reusable.navbar')

        <main class='container min-w-9/10 self-center'>
            <section class='self-center text-center'>
                <h1>Report Management</h1>
            </section>

            <section class='flex flex-col text-center'>
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
            </section>
        </main>

        @include('reusable.footer')
    @else
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="{{ route('/') }}">login</a> to access your account.</p>
    @endauth

</body>

</html>