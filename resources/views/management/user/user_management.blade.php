<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body>
    @auth
    @include('reusable.navbar')

    <main >
        <section class='self-center text-center'>
            <h1>Report Management</h1>
        </section>

        <section class='flex flex-col justify-start gap-10 p-10 border-2 border-gray-300 bg-white shadow-md'>
            <div class='flex flex-row justify-around gap-10'>
                <h2>All Users</h2>
                <a href='user_management/create_user/'>Create New User</a>
            </div>

            <table class='list-table'>
                <thead>
                    <tr class='text-center'>
                        <td>UserID</td>
                        <td>Full Name</td>
                        <td>Email</td>
                        <td>Update</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user => $Data) 
                        <tr>
                            <td>{{$Data['id']}}</td> 
                            <td><a href='user_management/view_user/{{$Data['id']}}'>{{$Data['name']}}</a></td> 
                            <td>{{$Data['email']}}</td> 
                            <td><a href='user_management/update_user/{{$Data['id']}}'>Update</a></td>
                            <td>
                                <form method="POST" action='user_management/delete_user/{{$Data['id']}}'>
                                    @csrf
                                    @method('DELETE')
                                    <button href=''>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
    
    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
</body>
</html>