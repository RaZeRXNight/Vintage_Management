<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('reusable.head')

    <body>
    @auth
    @include('reusable.navbar')
        <main class="centered_main">
            <section class="flex flex-col items-center p-7 max-w-5/10 justify-self-center rounded-2xl">
                <h2>Register</h2>

                <form class='form-section' action="/user_management/create_user" method="POST">
                    @csrf
                    <section class='flex flex-row justify-around gap-10'>

                        <input name="name" type="text" placeholder="Name" required /> <br />

                        <select class='text-center' id='role' name='role' required>
                            <option disabled selected>Choose a Role</option>
                            <option value='admin'>Admin</option>
                            <option value='user'>User</option>
                            <option value='sales'>Sales</option>
                            <option value='inventory'>Inventory</option>
                        </select>
                    </section>

                    <input id='email' name="email" type="email" placeholder="E-mail" required /> <br />

                    <input name="password" type="password" placeholder="Password" required /> <br />

                    <button>Register</button>
                </form>
            </section>
        </main>
    @else 
        <!-- Be present above all else. - Naval Ravikant -->
        <p>You must be logged in to view this page.</p>
        <p>Please <a href="/">login</a> to access your account.</p>
    @endauth
    </body>
</html>
