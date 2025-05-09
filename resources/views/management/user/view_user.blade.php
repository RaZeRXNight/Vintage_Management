<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body>
    @auth
    @include('reusable.navbar')

    <section>
        <div class="container mt-5 mb-5">
            <h2>User Details</h2>
            <div class="card mt-3 mb-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name: {{ $user['id'] }}</li>
                    <li class="list-group-item">Email: {{ $user['email'] }}</li>
                    <li class="list-group-item">Phone: {{ $user['phone'] }}</li>
                    <li class="list-group-item">Address: {{ $user['address'] }}</li>
                    <li class="list-group-item">Role: {{ $user['role'] }}</li>
                    <li class="list-group-item">Status: {{ $user['status'] }}</li>
                    <li class="list-group-item">Created At: {{ $user['created_at'] }}</li>
                    <li class="list-group-item">Updated At: {{ $user['updated_at'] }}</li>
                </ul>
            </div>
            
        </div>
    </section>

    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <?php redirect('/') ?>
    @endauth
    
</body>
</html>