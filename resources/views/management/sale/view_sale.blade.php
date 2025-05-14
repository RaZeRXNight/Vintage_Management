
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
    @auth
    @include('reusable.navbar')
    
    @else 
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="{{ route('/') }}">login</a> to access your account.</p>
    @endauth
    
    </body>
</html>

