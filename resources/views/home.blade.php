<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
        @include('reusable.navbar')
    @auth
        <main class='flex flex-row justify-start p-2 gap-2'>
            <section class='flex flex-col justify-start border-2 min-w-8/10 p-2 gap-2'>
                <div class='flex flex-row justify-start'>
                    <h1>Role: {{ucfirst(Auth()->user()->role)}}</h1>
                    
                </div>

                <div class='min-w-9/10 border-2 p-2'>
                    <table class='list-table'>
                        <thead>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th># In Stock</th>
                            <th># Lowest</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product => $details)
                                <tr>
                                    <td>{{ $details->id }}</td>
                                    <td>{{ $details->ProductName }}</td>
                                    <td>{{ $details->Description }}</td>
                                    <td>{{ $details->UnitsInStock }}</td>
                                    <td>{{ $details->ReorderLevel }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
            </section>

            <section class='border-2 min-w-2/10 p-2'>
                <!-- Quick Create Links -->
                <div class='flex flex-col min-h-1/10 border-2 p-2'>
                    <a href="/product_management/create_product">Create Product</a>
                    <a href="/product_management/category/create_category">Create Category</a>
                    <a href="/product_management/supplier/create_supplier">Create Supplier</a>
                    <a href="/product_management/order/create_order">Create Order</a>
                    <a href="/sale_management/create_sale">Create Sale</a>
                    <a href='user_management/create_user/'>Create New User</a>
                </div>
            </section>
        </main>
    @else 
        <main>
            <div class='container justify-items-center items-center flex flex-col p-52'>
                <h1 class='text-4xl font-bold mb-4'>Welcome to Our Application</h1>
                <p class='text-lg mb-8'>Please log in to continue.</p>
                @include('reusable.login')
            </div>
        </main>
    @endauth
        @include('reusable.footer')
    </body>
</html>
