<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('Reusable.head')

@php
    use App\Models\categorie;
    $Categories = categorie::all();
    $Sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL', '4X'];
@endphp

<body>
    @auth
        @include('Reusable.navbar')

        <main class='flex flex-col justify-around border rounded-4xl p-10 justify-self-center min-h-full'>
            <div class='form-section'>
                <h1 class='text-lg'>Create Product</h1>
                <p>Fill in the details below to create a new product.</p>
            </div>

            <form class='form-content' action="/product_management/create_product"
                enctype="multipart/form-data" method="POST">
                @csrf
                <section class='form-section'>
                    <div class="text-center p-2">
                        <label for="ProductName">Product Name:</label> <br />
                        <input class='border text-center rounded-2xl min-w-full' type="text" name="ProductName" required>
                    </div>

                    <div class="text-center p-2">
                        <label for="ProductIMG">Product Image:</label> <br />
                        <input class='text-sm text-center border' type="file" id="ProductIMG" name="ProductIMG"
                            accept="image/*">
                    </div>

                    <div class="text-center p-2">
                        <label for="Description">Product Description:</label> </br>
                        <small>Use Markdown syntax for formatting.</small> </br>
                        <textarea class='border rounded-b-3xl min-w-full' id="Description" name="Description"></textarea>
                    </div>
                </section>

                <section class='form-section'>
                    <div>
                        <label for="Size">Size:</label> <br />
                        <select class='border text-center rounded-2xl min-w-full' type="number" class="form-control"
                            id="Size" name="Size">
                            <option value='0' disabled selected>Select A Size</option>
                            <option value='N/A' >N/A</option>
                            @foreach($Sizes as $Size)
                                <option value={{ $Size }}>{{ $Size }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group-row" class=''>
                        <div>
                            <label for="SupplierID">Supplier ID:</label> <br />
                            <input class='text-center border rounded-2xl' type="number" class="form-control" id="SupplierID"
                                name="SupplierID">
                        </div>

                        <div>
                            <label for="CategoryID">Category ID:</label> <br />
                            <select class='border text-center rounded-2xl min-w-full' type="number" class="form-control"
                                id="CategoryID" name="CategoryID">
                                <option value='0' disabled selected>Select A Category</option>
                                @foreach($Categories as $category => $details)
                                    <option value={{ $details->ID }}>{{ $details->CategoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </section>

                <section class='flex flex-row pb-3 border-b-1 gap-2 border-dashed mb-3 justify-around text-center'>

                    <div class="form-group">
                        <div>
                            <label for="UnitPrice">Product Selling Price:</label> <br />
                            <input class='border text-center rounded-2xl min-w-full' type="number" class="form-control"
                                id="UnitPrice" name="UnitPrice" required step="0.01" min="0">
                        </div>

                        <div>
                            <label for="UnitsInStock">Product In Stock:</label> <br />
                            <input class='border text-center rounded-2xl min-w-full' type="number" class="form-control"
                                id="UnitsInStock" name="UnitsInStock" required min="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="UnitsOnOrder">Product On Order:</label> <br />
                            <input class='border text-center rounded-2xl min-w-full' type="number" class="form-control"
                                id="UnitsOnOrder" name="UnitsOnOrder" required min="0">
                        </div>
                        <div>
                            <label for="ReorderLevel">Product Reorder Level:</label> <br />
                            <input class='border text-center rounded-2xl min-w-full' type="number" class="form-control"
                                id="ReorderLevel" name="ReorderLevel" min="0" value="0" required>
                        </div>
                    </div>
                </section>

                <section class='flex flex-col pb-3 border-b-1 border-dashed mb-3 justify-around text-center'>
                    <div class="flex flex-col border-dashed justify-around text-center">
                        <select class="form-control" id="Discontinued" name="Discontinued" required>
                            <option class='text-center' value="" disabled selected>Select Discontinued Status</option>
                            <option class='text-center' value="0">No</option>
                            <option class='text-center' value="1">Yes</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </section>
                </div>
            </form>
        </main>
    @else
        <!-- Be present above all else. - Naval Ravikant -->
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="/">login</a> to access your account.</p>
    @endauth

</body>

</html>