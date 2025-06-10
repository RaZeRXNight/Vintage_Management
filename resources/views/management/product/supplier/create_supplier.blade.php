<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('reusable.head')

<body>
    @auth
        @include('reusable.navbar')

        <main class='container self-center'>
            <section>

            </section>

            <section>
                <form method="POST" action='/product_management/supplier/create_supplier'>
                    @csrf
                    <h1 class='text-center'>Create Supplier</h1>
                    <section>
                        <p class='text-center'>Fill in the details below to create a new supplier.</p>
                    </section>
                    <section class='bi-column-section'>
                        <section class='form-section'>
                            <label for="SupplierName">Supplier Name:</label>
                            <input type="text" id="SupplierName" name="SupplierName" required>

                            <label for="ContactName">Contact Name:</label>
                            <input type="text" id="ContactName" name="ContactName">
                        </section>

                        <section class='form-section'>
                            <label for="Phone">Phone Number:</label>
                            <input type="tel" id="Phone" name="Phone">

                            <label for="ContactEmail">Email:</label>
                            <input type="email" id="ContactEmail" name="ContactEmail">
                        </section>
                    </section>

                    
                    <section class='bi-column-section'>
                        <div class='form-section'>
                            <label for="Country">Country:</label>
                            <input type="text" id="Country" name="Country">

                            <label for="State">State:</label>
                            <input type="text" id="State" name="State">

                            <label for="City">City:</label>
                            <input type="text" id="City" name="City">
                        </div>

                        <div class='form-section'>
                            <label for="Address">Address:</label>
                            <input type="text" id="Address" name="Address">

                            <label for="PostalCode">Postal Code:</label>
                            <input type="text" id="PostalCode" name="PostalCode">
                        </div>
                    </section>
                    
                    <section>
                        <button type='submit' class='btn btn-primary'>Create Supplier</button>
                    </section>
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