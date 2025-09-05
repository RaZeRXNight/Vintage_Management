<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body class='flex flex-col '>
    @auth
    @include('reusable.navbar')
    <main class='centered_main container self-center'>

    <section class='flex flex-row min-w-full justify-center'>
        <div class="content">
            <h1>Sale Management</h1>
            <p>Welcome to the Sale Management page!</p>
            <p>Here you can manage your sales effectively.</p>
            
            <a href='/sale_management/create_sale' class="btn btn-primary mb-4"><h1>Create Sale</h1></a>
        </div>
    </section>

   <div class="container mx-auto">
       <table class="list-table">
        <h1 class="text-2xl font-bold mb-4">Transactions Management</h1>
           <thead>
               <tr>
                   <th>Transaction ID</th>
                   <th>User ID</th>
                   <th>Quantity</th>
                   <th>Total Price</th>
                   <th>Transaction Date</th>
                   @if(auth()->user() && auth()->user()->role === 'admin')
                       <th>Action</th>
                   @endif
               </tr>
           </thead>
           <tbody>
               @foreach ($transactions as $transaction)
                   <tr>
                       <td><a href="/sale_management/view_transaction/{{ $transaction->id }}"> {{ $transaction->id }} </a></td>
                       <td>{{ $transaction->UserID }}</td>
                       <td>{{ $transaction->Quantity }}</td>
                       <td>${{ $transaction->TotalPrice }}</td>
                       <td>{{ $transaction->created_at }}</td>
                       @if(auth()->user() && auth()->user()->role === 'admin')
                            {{-- <td><a href="/sale_management/update_transaction/{{ $transaction->id }}">Manage</a></td> --}}
                            <td><form action="/sale_management/delete_transaction/{{ $transaction->id }}" method="POST" style="display:inline;">
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
    </main>
    @else
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>

