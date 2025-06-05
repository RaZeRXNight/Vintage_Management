<main class='flex flex-col justify-center items-center'>
    <section class="flex flex-col items-center p-7 
    border rounded-2xl shadow-xl 
    size-2/6
    justify-self-center">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="email" type="email" placeholder="E-mail" /> <br />
            <input name="password" type="password" placeholder="Password" /> <br />
            <button>Log In</button>
        </form>
    </section>
</main>
