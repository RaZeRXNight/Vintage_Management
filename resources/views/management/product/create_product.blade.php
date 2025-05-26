<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('Reusable.head')

    <body>
    @auth
    @include('Reusable.navbar')

    <main class='flex flex-col justify-around border rounded-4xl gap-5 p-10 justify-self-center min-h-full'>
        <div class='flex flex-col items-center border-b-1 border-dashed mb-5'>
            <h1 class='text-lg'>Create Product</h1>
            <p>Fill in the details below to create a new product.</p>
        </div>
        <form class='container flex flex-col gap-10 min-w-75' action="/product_management/create_product" method="POST">
            @csrf
            <section class='flex flex-col pb-3 border-b-1 border-dashed mb-2'>
                <div class="text-center p-2">
                    <label for="ProductName">Product Name:</label> <br/>
                    <input class='border text-center rounded-2xl min-w-full' type="text" name="ProductName" required>
                </div>

                <div class="text-center p-2">
                    <label for="ProductIMG">Product Image:</label> <br/>
                    <input class='text-sm text-center border' type="file" id="ProductIMG" name="ProductIMG" accept="image/*">
                </div>

                <div class="text-center p-2">
                    <label for="Description">Product Description:</label> </br>
                    <small>Use Markdown syntax for formatting.</small> </br>
                    <textarea class='border rounded-b-3xl min-w-full' id="Description" name="Description"></textarea>
                </div>
            </section>

            <section class='flex flex-row pb-3 border-b-1 border-dashed mb-3 gap-2 justify-around text-center'>
                <div>
                    <label for="SupplierID">Supplier ID:</label> <br/>
                    <input class='text-center border rounded-2xl'  type="number" class="form-control" id="SupplierID" name="SupplierID">
                </div>

                <div>
                    <label for="CategoryID">Category ID:</label> <br/>
                    <input class='border text-center rounded-2xl min-w-full'  type="number" class="form-control" id="CategoryID" name="CategoryID">
                </div>
            </section>

            <section class='flex flex-row pb-3 border-b-1 gap-2 border-dashed mb-3 justify-around text-center'>
                
                <div class="flex flex-col">
                    <div>
                        <label for="UnitPrice">Product Price:</label> <br/>
                        <input class='border text-center rounded-2xl min-w-full'  type="number" class="form-control" id="UnitPrice" name="UnitPrice" required step="0.01" min="0">
                    </div>

                    <div>
                        <label for="UnitsInStock">Product In Stock:</label> <br/>
                        <input class='border text-center rounded-2xl min-w-full'   type="number" class="form-control" id="UnitsInStock" name="UnitsInStock" required min="0">
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="UnitsOnOrder">Product On Order:</label> <br/>
                        <input class='border text-center rounded-2xl min-w-full'   type="number" class="form-control" id="UnitsOnOrder" name="UnitsOnOrder" required min="0">
                    </div>
                    <div>
                        <label for="ReorderLevel">Product Reorder Level:</label> <br/>
                        <input class='border text-center rounded-2xl min-w-full'   type="number" class="form-control" id="ReorderLevel" name="ReorderLevel" min="0" value="0" required>
                    </div>
                </div>
            </section>

            <section class='flex flex-col pb-3 border-b-1 border-dashed mb-3 justify-around text-center' >
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
