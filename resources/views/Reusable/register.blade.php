<section class="flex flex-col items-center p-7 rounded-2xl">
    <h2>Register</h2>
    <form action="/register" method="POST">
        @csrf
        <input name="name" type="text" placeholder="Name" required /> <br />
        <input name="email" type="email" placeholder="E-mail" required /> <br />
        @if(auth()->user()->role == 'admin')
            <input name='role' type="text" placeholder="Role (admin/user)" required /> <br />
        @else
            <input name='role' type="hidden" value="user" />
            <input name='role' type="text" value="user" readonly /> <br />
        @endif
        <input name="password" type="password" placeholder="Password" required /> <br />
        <button>Register</button>
    </form>
</section>