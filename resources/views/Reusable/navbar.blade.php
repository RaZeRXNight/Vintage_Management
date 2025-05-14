<header class="flex flex-col items-center p-7 rounded-2xl">

    @auth
    <h2>Welcome User!</h2>
    <div class="flex flex-row items-center p-7 rounded-2xl">
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
        <a href='/'>Dashboard</a>
        
        <a href='/product_management'>Product Management</a>

        <a href='/user_management'>User Management</a>

        <a href='/sale_management'>Sale Management</a>

        <a href='/report_management'>Report Management</a>
        <form action="/logout" method="POST"> @csrf <button>Log Out</button> </form>
    </div>
    @else
    <h2>Welcome Guest!</h2>
        
    @endauth
</header>
