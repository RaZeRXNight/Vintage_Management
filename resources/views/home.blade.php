<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        @endif
    </head>

    <body>
    @auth
     <section class="flex flex-col items-center p-7 rounded-2xl">
     <p>Welcome User!</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log Out</button>
        </form>
    </section>
    @else 
    <section class="flex flex-col items-center p-7 rounded-2xl">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="email" type="email" placeholder="E-mail" /> <br />
            <input name="password" type="password" placeholder="Password" /> <br />
            <button>Log In</button>
        </form>
    
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Name" /> <br />
            <input name="email" type="email" placeholder="e-mail" /> <br />
            <input name="password" type="password" placeholder="Password" /> <br />
            <button>Register</button>
        </form>
    </section>
    @endauth

    </body>
</html>
