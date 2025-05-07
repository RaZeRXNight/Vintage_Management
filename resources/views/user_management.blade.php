<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body>
    @auth
    @include('reusable.navbar')

    <section>
        <h2>All Users</h2>
        <table>
            <th>
                <td>Employee ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>Created At</td>
                <td>Updated At</td>
            </th>
        @foreach($users as $user => $Data) 
            <tr>
                <td>{{$Data['id']}}</td>
                <td>{{$Data['name']}}</td>
                <td>{{$Data['email']}}</td>
                <td>{{$Data['created_at']}}</td>
                <td>{{$Data['updated_at']}}</td>
            </tr>
        @endforeach
        </table>
    </section>

    @else 
    <!-- Be present above all else. - Naval Ravikant -->

    @endauth
    
</body>
</html>