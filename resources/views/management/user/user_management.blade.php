<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body>
    @auth
    @include('reusable.navbar')

    <main>
        <h2>All Users</h2>
        <table class='list-table'>
        @foreach($users as $user => $Data) 
            <tr>
                <td>{{$Data['id']}}</td> 
                <td><a href='user_management/view_user/{{$Data['id']}}'>{{$Data['name']}}</a></td> 
                <td>{{$Data['email']}}</td> 
                <td><a href='user_management/update_user/{{$Data['id']}}'>Update</a></td>
                <td><a href='user_management/delete_user/{{$Data['id']}}'>Delete</a></td>
            </tr>
        @endforeach
        </table>
    </main>
    
    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
</body>
</html>