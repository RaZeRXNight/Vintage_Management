<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body class="flex flex-col">
    @auth
        <form id='Hidden-Stash' hidden>
            <input type='hidden' id='products-data' value='@json($products)'>
            <input type='hidden' id='suppliers-data' value='@json($suppliers)'>
            <input type='hidden' id='orders-data' value='@json($orders)'>
            <input type='hidden' id='categories-data' value='@json($categories)'>
        </form>
        @include('Reusable.navbar')
        <main class="centered_main">
            <section class='flex flex-row min-w-full justify-center'>
                <div class="content">
                    <!-- Add your content here -->
                    <h1>Product Management</h1>
                    <p>Manage your products efficiently.</p>
                    <div>
                        <a class="btn btn-primary" href='/product_management/create_product'>Create Product</a>
                        <a class="btn btn-primary" href="/product_management/category/create_category">Create Category</a>
                        <a class="btn btn-primary" href="/product_management/supplier/create_supplier">Create Supplier</a>
                        <a class="btn btn-primary" href="/product_management/order/create_order">Create Order</a>
                    </div>
                </div>
            </section>

            <!-- Products & Categories -->
            <section class='flex flex-row justify-evenly max-h-fit max-w-full'>
                <!-- Products Suppliers & Orders -->
                <section class='flex flex-col gap-5 rounded-main-container'>
                    <section class="container-border-full" id='product-management'>
                        <div class='flex flex-col justify-center'>
                            <h2 class='text-center'>Products</h2>
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

                    <!-- Suppliers & Orders -->
                    <section class="container-border-full" id='supplier-management'>
                        <div class='flex flex-col justify-center'>
                            <h2 class='text-center'>Suppliers</h2>
                            <h3 id='Current_Filter'>Showing All</h3>
                            <input class='text-center' id='Search' type='text' placeholder='Search for Supplier'>
                        </div>
                        <table class="list-table">
                            <thead>
                                <tr>
                                    <th>Supplier ID</th>
                                    <th>Supplier Name</th>
                                    <th>Contact Name</th>
                                    <th>Contact Email</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody id='suppliers-items'>
                                <!-- Supplier rows will be populated here -->
                            </tbody>
                        </table>
                        <div class='pagination-controls' id='pagination-controls'>

                        </div>
                    </section>
                </section>
                <!-- Categories -->
                <section class="rounded-side-container" id='category-management'>
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
                                @foreach ($categories as $Category => $details)
                                    <tr>
                                        <td><button data-id={{ $details->id }}>{{ $details->CategoryName }}</button></td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>

                </section>
            </section>
        </main>
    @else
        <!-- Be present above all else. - Naval Ravikant -->
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="/">login</a> to access your account.</p>
    @endauth

</body>

</html>