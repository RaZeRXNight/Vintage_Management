<section class="flex flex-col items-center p-7 
border rounded-2xl shadow-xl 
size-3/6
justify-self-center">
    <h2>Login</h2>
    <form class='min-w-4/6' action="/login" method="POST">
        @csrf
        <input name="email" type="email" placeholder="E-mail" /> <br />
        <input name="password" type="password" placeholder="Password" /> <br />
        <button>Log In</button>
    </form>
</section>