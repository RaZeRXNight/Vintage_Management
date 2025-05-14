<div>
    

    <form action='Product_Search' method='POST'>
        @csrf
        <div class="mb-4">
            <label for="product_name" class="block text-gray-700">Product Name:</label>
            <input type="text" name="product_name" id="product_name" class="border rounded w-full py-2 px-3" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Search</button>
    </form>

    <div class="mb-4">
        @if (isset($productsales) && count($productsales) == 0)
            <p class="text-red-500">No products Added.</p>
        @else
            <p class="text-green-500">Products Added:</p>
            @foreach ($productsales as $item)
                <div class="border rounded p-4 mb-2">
                    <h2 class="text-lg font-bold">{{ $item->ProductName }}</h2>
                    <p>Price: {{ $item->Price }}</p>
                    <p>Stock: {{ $item->Stock }}</p>
                    <p>Description: {{ $item->Description }}</p>
                </div>
            @endforeach
        @endif
    </div>

    <li class="list-none">
        @foreach($products as $product)
            <div class="border rounded p-4 mb-2">
                <button onclick="addProduct({{ $product->ID }})" class="bg-blue-500 text-white py-2 px-4 rounded"><img src="{{ $product->ProductIMG }}"
                    alt="{{ $product->ProductName }}" class="w-16 h-16"></button>
                <h2 class="text-lg font-bold">{{ $product->ProductName }}</h2>
                <p>Price: {{ $product->UnitPrice }}</p>
                <p>Stock: {{ $product->UnitsInStock }}</p>
                <p>Description: {{ $product->Description }}</p>
            </div>
        @endforeach
    </li>

</div>