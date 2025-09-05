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
                <form method="POST" action="/product_management/category/create_category">
                    @csrf
                    <h1 class='text-center'>Create Category</h1>
                    <section>
                        <p class='text-center'>Fill in the details below to create a new product category.</p>
                    </section>
                    <section class='bi-column-section'>
                        <div class="text-center flex flex-col items-center">
                            <label for="CategoryName">Category Name:</label>
                            <input type="text" id="CategoryName" name="CategoryName" required>
                        </div>
                        <div class="text-center flex flex-col items-center">
                            <label for="Description">Description:</label>
                            <textarea id="Description" name="Description" rows="2" required></textarea>
                        </div>
                    </section>
                    <button type="submit" class="btn btn-primary">Create Category</button>
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