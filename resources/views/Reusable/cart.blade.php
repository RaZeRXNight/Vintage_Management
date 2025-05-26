<?php $products = DB::table('products')->get(); ?>

<article id='Transaction'>
    <h3>Available Products</h3>
    <div id='row'>
        @foreach($products as $product)
            <div class='col-md-3'>
                <div class='product-card' data-id='{{ $product->ID }}' data-name='{{ $product->ProductName }}'
                    data-price='{{ $product->UnitPrice }}' data-quantity='{{ $product->UnitsInStock }}'>
                    <span>{{ $product->ProductName }}</span>
                    <span>{{ $product->UnitPrice }}</span>
                    <span>{{ $product->UnitsInStock }}</span>
                    <button class='add-to-cart'>Add to Cart</button>
                </div>
            </div>
        @endforeach
    </div>
    <h3>Cart</h3>
    <table id='cart'>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id='cart-items'>
            <!-- Cart items will be dynamically added here -->


        </tbody>
    </table>
    <label for='cart-total'>Total: </label>
    <input type='number' id='cart-total' value='0' readonly step='0.01' /></br>
</article>