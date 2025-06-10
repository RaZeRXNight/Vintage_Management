<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
    @auth
    @include('reusable.navbar')
    <main>
        
    </main>
    
    @else 
    <main>
        @include('reusable.login')
    </main>
    @endauth
    
    </body>
</html>
