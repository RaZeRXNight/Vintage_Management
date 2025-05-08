<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body>
    @auth
    @include('reusable.navbar')

    <section>
        <h2>All Users</h2>
        <table>
        @foreach($users as $user => $Data) 
            <tr>
                <td>{{$Data['id']}}</td> 
                <td>{{$Data['name']}}</td> 
                <td>{{$Data['email']}}</td> 
                
                <div>
                <a href='user_management/view_user/{{$Data['id']}}'>View</a>
                <a href='user_management/update_user/{{$Data['id']}}'>Update</a>
                <a href='user_management/delete_user/{{$Data['id']}}'>Delete</a>
                </div>
            </tr>
        @endforeach
        </table>
    </section>

    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <?php redirect('/') ?>
    @endauth
    
</body>
</html>