<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('reusable.head')

<body>
    @auth
        @include('reusable.navbar')

        <main class='centered_main container self-center'>
            <section>

            </section>

            <section>
                <form action="/product_management/order/create_order" method="POST">
                    @csrf
                    <h1 class="text-2xl font-bold mb-4">Create New Order</h1>
                    
                    <section>
                        
                    </section>
                    <section class='bi-column-section'> 
                        <section>
                            <div class="mb-4">
                                <label for="product_id" class="block text-gray-700">Product ID:</label>
                                <input type="text" name="product_id" id="product_id" class="form-input mt-1 block w-full" required>
                            </div>
                            <div class="mb-4">
                                <label for="quantity" class="block text-gray-700">Quantity:</label>
                                <input type="number" name="quantity" id="quantity" class="form-input mt-1 block w-full" required>
                            </div>
                        </section>

                        <section class=>
                            <div class="mb-4">
                                <label for="status" class="block text-gray-700">Order Status:</label>
                                <select name="status" id="status" class="form-select mt-1 block w-full" required>
                                    <option value="pending">Pending</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="order_date" class="block text-gray-700">Order Date:</label>
                                <input type="date" name="order_date" id="order_date" class="form-input mt-1 block w-full" required>
                            </div>
                        </section>
                    </section>
                    <section class='bi-column-section'>
                        <section>
                            <div>
                                <label for='Quantity'>Quantity:</label> 
                                <input type='number' name='quantity' id='quantity' required>
                            </div>
                    <button type="submit" class="btn btn-primary">Create Order</button>
                </form>
            </section>

        </main>

        @include('reusable.footer')
    @else
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="{{ route('/') }}">login</a> to access your account.</p>
    @endauth

</body>

</html>