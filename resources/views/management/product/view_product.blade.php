<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
    @auth
    @include('reusable.navbar')

    <main>
        <section class="product-list">
            <h2>Product List</h2>
            <div class="container">
                <h1>View Product</h1>
                <!-- Add your product view content here -->
                <div class="product-details">
                    <img src='{{ asset('storage/'. $product->ProductIMG) }}' alt='Product Image' />
                    <h2>Product ID: {{ $product->ID }}</h2>
                    <p><strong>Name:</strong> {{ $product->ProductName }}</p>
                    <p><strong>Description:</strong> {{ $product->Description }}</p>
                    <p><strong>Price:</strong> {{ $product->UnitPrice }}</p>
                </div>
                <a href="/product_management/update_product/{{ $product->ID }}" class="btn btn-warning">Edit Product</a>
                <form action="/product_management/delete_product/{{ $product->ID }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Product</button>
                </form>
            </div>
        </section>
    </main>
    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>