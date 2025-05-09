<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
    @auth
    @include('reusable.navbar')
    
    <section class="product-list">
        <h2>Product List</h2>
        <div class="container">
            <h1>Update Product</h1>
            <!-- Add your product update content here -->
            <form action="/product_management/update_product/{{ $product->ID }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="ProductName">Product Name:</label>
                    <input type="text" class="form-control" name="ProductName" value="{{ $product->ProductName }}" required>
                </div>
    
                <div class="form-group">
                    <label for="ProductIMG">Product Image:</label> </br>
                    <input type="file" class="form-control" id="ProductIMG" name="ProductIMG" accept="image/*" value="{{ $product->ProductIMG }}">
                </br> <small>Upload a new image if you want to change it.</small> </br>
                </div>
    
                <div class="form-group">
                    <label for="Description">Product Description:</label> </br>
                    <small>Use Markdown syntax for formatting.</small> </br>
                    <textarea class="form-control" id="Description" name="Description">{{$product->Description}}</textarea>
                </div>
                
                <section>
                    <h2>Product Statistics</h2>
                    <p>Fill in the details below to update the product statistics.</p>
                    <div class="form-group">
                        <label for="SupplierID">Supplier ID:</label>
                        <input type="number" class="form-control" id="SupplierID" name="SupplierID" value="{{ $product->SupplierID }}">
                    </div>
        
                    <div class="form-group">
                        <label for="CategoryID">Category ID:</label>
                        <input type="number" class="form-control" id="CategoryID" name="CategoryID" value="{{ $product->CategoryID }}">
                    </div>
        
                    <div class="form-group">
                        <label for="UnitPrice">Product Price:</label>
                        <input type="number" class="form-control" id="UnitPrice" name="UnitPrice" value="{{ $product->UnitPrice }}" required step="0.01" min="0">
                    </div>
        
                    <div class="form-group">
                        <label for="UnitsInStock">Product In Stock:</label>
                        <input type="number" class="form-control" id="UnitsInStock" name="UnitsInStock" value="{{ $product->UnitsInStock }}" required min="0">
                    </div>

                    <div class="form-group">
                        <label for="UnitsOnOrder">Product On Order:</label>
                        <input type="number" class="form-control" id="UnitsOnOrder" name="UnitsOnOrder" value="{{ $product->UnitsOnOrder }}" required min="0">
                    </div>
        
                    <div class="form-group">
                        <label for="ReorderLevel">Product Reorder Level:</label>
                        <input type="number" class="form-control" id="ReorderLevel" name="ReorderLevel" value="{{ $product->ReorderLevel}}" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="Discontinued">Product Discontinued:</label>
                        <select class="form-control" id="Discontinued" name="Discontinued" required>
                            <option value="" disabled selected>Select Discontinued Status</option>
                            <option value="0" {{ $product->Discontinued == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $product->Discontinued == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </section>
    
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </section>
    @else 
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="{{ route('home') }}">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>

