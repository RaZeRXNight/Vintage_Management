<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
    @auth
    @include('reusable.navbar')
    <div class="container">
        <h1>Sale Management</h1>
        <p>Welcome to the Sale Management page!</p>
        <p>Here you can manage your sales effectively.</p>
        
        <a href='/sale_management/create_sale' class="btn btn-primary mb-4">Create Sale</a>
        <a href='/sale_management/create_transaction' class="btn btn-primary mb-4">Create Transaction</a>
    </div>
   <div class="container mx-auto">
       <h1 class="text-2xl font-bold mb-4">Transactions Management</h1>
       <table class="min-w-full bg-white border border-gray-200">
           <thead>
               <tr>
                   <th class="py-2 px-4 border-b">Transaction ID</th>
                   <th class="py-2 px-4 border-b">User ID</th>
                   <th class="py-2 px-4 border-b">Quantity</th>
                   <th class="py-2 px-4 border-b">Total Price</th>
                   <th class="py-2 px-4 border-b">Transaction Date</th>
                   @if(auth()->user() && auth()->user()->role === 'admin')
                       <th class="py-2 px-4 border-b">Actions</th>
                   @endif
               </tr>
           </thead>
           <tbody>
               @foreach ($transactions as $transaction)
                   <tr>
                       <td class="py-2 px-4 border-b"><a href="/sale_management/view_sale/{{ $transaction->TransactionID }}"> {{ $transaction->TransactionID }} </a></td>
                       <td class="py-2 px-4 border-b">{{ $transaction->UserID }}</td>
                       <td class="py-2 px-4 border-b">{{ $transaction->Quantity }}</td>
                       <td class="py-2 px-4 border-b">${{ $transaction->TotalPrice }}</td>
                       <td class="py-2 px-4 border-b">{{ $transaction->created_at }}</td>
                       @if(auth()->user() && auth()->user()->role === 'admin')
                            <td class="py-2 px-4 border-b"><a href="/sale_management/update_sale/{{ $transaction->TransactionID }}">Manage</a></td>
                            <td><form action="/sale_management/delete_transaction/{{ $transaction->TransactionID }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button></td>
                            </form>
                       @endif
                   </tr>
               @endforeach
           </tbody>
       </table>
   </div>
    @else
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>

