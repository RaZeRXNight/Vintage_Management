<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
    @auth
    @include('reusable.navbar')
    <section class="flex flex-col items-center p-7 rounded-2xl">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="email" type="email" placeholder="E-mail" /> <br />
            <input name="password" type="password" placeholder="Password" /> <br />
            <button>Log In</button>
        </form>
    </section>
    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="{{ route('home') }}">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>
