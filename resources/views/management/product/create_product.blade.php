<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('Reusable.head')

    <body>
    @auth
    @include('Reusable.navbar')

    <form action="/product_management/create_product" method="POST">
        @csrf
        <div class="container">
            <h1>Create Product</h1>
            <p>Fill in the details below to create a new product.</p>

            <div class="form-group">
                <label for="ProductName">Product Name:</label>
                <input type="text" class="form-control" name="ProductName" required>
            </div>

            <div class="form-group">
                <label for="ProductIMG">Product Image:</label> </br>
                <input type="file" class="form-control" id="ProductIMG" name="ProductIMG" accept="image/*">
                </div>

            <div class="form-group">
                <label for="Description">Product Description:</label> </br>
                <small>Use Markdown syntax for formatting.</small> </br>
                <textarea class="form-control" id="Description" name="Description"></textarea>
            </div>

            <div class="form-group">
                <label for="SupplierID">Supplier ID:</label>
                <input type="number" class="form-control" id="SupplierID" name="SupplierID">
            </div>

            <div class="form-group">
                <label for="CategoryID">Category ID:</label>
                <input type="number" class="form-control" id="CategoryID" name="CategoryID">
            </div>

            <div class="form-group">
                <label for="UnitPrice">Product Price:</label>
                <input type="number" class="form-control" id="UnitPrice" name="UnitPrice" required step="0.01" min="0">
            </div>

            <div class="form-group">
                <label for="UnitsInStock">Product In Stock:</label>
                <input type="number" class="form-control" id="UnitsInStock" name="UnitsInStock" required min="0">
            </div>

            <div class="form-group">
                <label for="UnitsOnOrder">Product On Order:</label>
                <input type="number" class="form-control" id="UnitsOnOrder" name="UnitsOnOrder" required min="0">
            </div>

            <div class="form-group">
                <label for="ReorderLevel">Product Reorder Level:</label>
                <input type="number" class="form-control" id="ReorderLevel" name="ReorderLevel" min="0" value="0" required>
            </div>

            <div class="form-group">
                <label for="Discontinued">Product Discontinued:</label>
                <select class="form-control" id="Discontinued" name="Discontinued" required>
                    <option value="" disabled selected>Select Discontinued Status</option>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Product</button>
            </div>
        </div>
    </form>
    @else 
        <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>
