<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

@php
    use App\Models\Categorie;
    $Categories = Categorie::All();
@endphp

<form id='Hidden-Stash' hidden>
    <input type='hidden' id='products-data' value='@json($products)'>
</form>

<body>
    @auth
    @include('Reusable.navbar')
    <main>

    <section class='flex flex-row min-w-full justify-center'>
        <div class="content">
            <!-- Add your content here -->
            <h1>Product Management</h1>
            <p>Manage your products efficiently.</p>
            <div>
            <a class="btn btn-primary" href='/product_management/create_product' >Create Product</a>
            </div>
        </div>
    </section>
    
    <article class='flex flex-row justify-evenly max-h-fit'>
        <!-- Products -->
        <section class="rounded-main-container">
            <div class='flex flex-col justify-center'>
                <h3 id='Current_Filter'>Showing All</h3>
                <input class='text-center' id='Search' type='text' placeholder='Search for Product'>
            </div>
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id='product-items'>
                    <!-- Product rows will be populated here -->
                </tbody>
            </table>
            <div class='pagination-controls' id='pagination-controls'>
                    
            </div>
        </section>

        <!-- Categories -->
        <section class="rounded-side-container">
            <h2>Categories</h2>
            <table class="list-table">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody id='Category-items'>
                    <!-- Product rows will be populated here -->
                    <tr>
                        <td><button data-id=0>All</button></td>
                    <tr>
                    @foreach ($Categories as $Category => $details)
                    <tr>
                        <td><button data-id={{ $details->id }}>{{ $details->CategoryName }}</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </section>
    </article>
    </main>
    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
</body>
</html>