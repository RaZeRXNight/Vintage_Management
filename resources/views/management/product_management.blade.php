<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body>
    @auth
    @include('reusable.navbar')

    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <?php redirect('/') ?>
    @endauth
    
</body>
</html>