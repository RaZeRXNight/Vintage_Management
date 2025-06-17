<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
        @include('reusable.navbar')
    @auth
        <main>
            
        </main>
    @else 
        <main>
            <div class='container justify-items-center items-center flex flex-col p-52'>
                <h1 class='text-4xl font-bold mb-4'>Welcome to Our Application</h1>
                <p class='text-lg mb-8'>Please log in to continue.</p>
            @include('reusable.login')
            </div>
        </main>
    @endauth
        @include('reusable.footer')
    </body>
</html>
