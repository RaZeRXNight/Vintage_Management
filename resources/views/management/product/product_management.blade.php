<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body>
    @auth
    @include('reusable.navbar')

    <div class="content">
        <!-- Add your content here -->
        <a class="btn btn-primary" href='/product_management/create_product' >Create Product</a>
        <h1>Product Management</h1>
        <p>Manage your products efficiently.</p>
    </div>

    <section class="product-list">
        <h2>Product List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Product rows will be populated here -->

                @foreach ($products as $product => $details)
                <tr>
                    <td>{{ $details->ID }}</td>
                    <td><a href="/product_management/view_product/{{ $details->ID }}">{{ $details->ProductName }}</td>
                    <td>{{ $details->Description }}</td>
                    <td>{{ $details->UnitPrice }}</td>
                    
                    <td>
                        <a href="/product_management/edit_product/{{ $details->ID }}" class="btn btn-warning">Edit</a>
                        <form action="/product_management/delete_product/{{ $details->ID }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                @endforeach
            </tbody>
        </table>
    </section>
    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
</body>
</html>