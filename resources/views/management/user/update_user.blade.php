<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('reusable.head')

<body>
    @auth
    @include('reusable.navbar')
    <main class='centered_main'>
        <section class="flex flex-col items-center p-7 rounded-2xl">
            <h2>Update User</h2>
            <form action="/update_user/{{ $user->id }}" method="POST">
                @csrf
                <input name="name" type="text" placeholder="Name" value="{{ $user->name }}" required /> <br />
                <input name="email" type="email" placeholder="E-mail" value="{{ $user->email }}" required /> <br />
                @if(auth()->user()->role == 'admin')
                    <input name='role' type="text" placeholder="Role (admin/user)" value="{{ $user->role }}" required /> <br />
                @else
                    <input name='role' type="hidden" value="user" />
                    <input name='role' type="text" value="user" readonly /> <br />
                @endif
                <input name="password" type="password" placeholder="Password" required /> <br />
                <button>Update</button>
            </form>
        </section>
    </main>
    @include('reusable.footer')
    @else 
    <!-- Be present above all else. - Naval Ravikant -->
    <p>You must be logged in to view this page.</p>
    <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    
</body>
</html>