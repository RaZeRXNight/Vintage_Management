<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
    @auth
    @include('reusable.navbar')
    
    @else 
    @include('reusable.login')
    @endauth
    
    </body>
</html>
