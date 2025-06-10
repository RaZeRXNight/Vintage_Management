<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')
    @php
        $Sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL', '4X'];
    @endphp

    <head>
        
    </head>

    <body>
    @auth
    @include('reusable.navbar')
    
    <main>
        <section class="product-list">
            <h2>Product List</h2>
                <!-- Add your product update content here -->
                <form class='form-content flex flex-col min-w-9/10 max-w-9/10 justify-self-center' action="/product_management/update_product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class='form-section text-center items-center'>
                        <h2>Update Product</h2>
                        <p>Fill in the details below to update the product statistics.</p>
                    </div>

                    <section class='bi-column-section border-b-1 border-dashed'>
                        <div class='form-section text-center items-center'>
                            <div>
                                <label for="ProductName">Product Name:</label>
                                <input type="text" class="form-control" name="ProductName" value="{{ $product->ProductName }}" required>
                            </div>
                
                            <div>
                                <label for="ProductIMG">Product Image:</label> </br>
                                <img class="rounded-t-2xl max-h-30" id="product-img-${item.id}" src='/storage/{{ $product->ProductIMG }}' alt='Product Image' />
                                <input type="file" class="form-control" id="ProductIMG" name="ProductIMG" accept="image/*" value="{{ $product->ProductIMG }}">
                            </br> <small>Upload a new image if you want to change it.</small> </br>
                            </div>
                
                            <div>
                                <label for="Description">Product Description:</label> </br>
                                <small>Use Markdown syntax for formatting.</small> </br>
                                <textarea class="form-control" id="Description" name="Description">{{$product->Description}}</textarea>
                            </div>
                        </div>

                        <div class='form-section'>
                            <div class=''>
                                <label for="Size">Size:</label> <br />
                                <select class='border text-center rounded-2xl min-w-full' type="number" class="form-control"
                                    id="Size" name="Size">
                                    <option value='0' disabled selected>Select A Size</option>
                                    <option value='N/A' >N/A</option>
                                    @foreach($Sizes as $Size)
                                        <option value={{ $Size }} {{ $Size == $product->Size ? 'selected' : '' }}>{{ $Size }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-section">
                                <select type="number" class="form-control"
                                    id="SupplierID" name="SupplierID">
                                    <option value='0' disabled selected>Select A Supplier</option>
                                    @if($Suppliers->isEmpty())
                                        <option value='0'>No Suppliers Available</option>
                                    @elseif ($Suppliers->count() >= 1)
                                        @foreach($Suppliers as $supplier => $details)
                                            <option value={{ $details->id }} {{ $details->id == $product->SupplierID ? 'selected' : '' }}>{{ $details->SupplierName }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-section">
                                <select type="number" class="form-control"
                                    id="CategoryID" name="CategoryID">
                                    <option value='0' disabled selected>Select A Category</option>
                                    @foreach($Categories as $category => $details)
                                        <option value={{ $details->id }} {{ $details->id == $product->CategoryID ? 'selected' : '' }}>{{ $details->CategoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </section>

                    <div class='form-section text-center items-center'>
                        <h2>Product Statistics</h2>
                        <p>Fill in the details below to update the product statistics.</p>
                    </div>
                    
                    <section class='bi-column-section'>
                        <div class="form-group">
                            <div>
                                <label for="BuyPrice">Product Buy Price:</label> <br />
                                <input type="number" class="form-control"
                                    id="BuyPrice" name="BuyPrice" value="{{ $product->BuyPrice }}" required min="0">
                            </div>

                            <div>
                                <label for="UnitsInStock">Product In Stock:</label>
                                <input type="number" class="form-control" id="UnitsInStock" name="UnitsInStock" value="{{ $product->UnitsInStock }}" required min="0">
                            </div>
                
                            <div>
                                <label for="UnitPrice">Product Price:</label>
                                <input type="number" class="form-control" id="UnitPrice" name="UnitPrice" value="{{ $product->UnitPrice }}" required step="0.01" min="0">
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="Discontinued">Product Discontinued:</label>
                                <select class="form-control" id="Discontinued" name="Discontinued" required>
                                    <option value="" disabled selected>Select Discontinued Status</option>
                                    <option value="0" {{ $product->Discontinued == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $product->Discontinued == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>

                            <div>
                                <label for="UnitsOnOrder">Product On Order:</label>
                                <input type="number" class="form-control" id="UnitsOnOrder" name="UnitsOnOrder" value="{{ $product->UnitsOnOrder }}" required min="0">
                            </div>
                
                            <div>
                                <label for="ReorderLevel">Product Reorder Level:</label>
                                <input type="number" class="form-control" id="ReorderLevel" name="ReorderLevel" value="{{ $product->ReorderLevel}}" min="0" required>
                            </div>
                        </div>
                    </section>

                    <div class="form-group self-center">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
        </section>
    </main>
    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>

