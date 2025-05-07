<header class="flex flex-col items-center p-7 rounded-2xl">

    @auth
    <h2>Welcome User!</h2>
    <div class="flex flex-row items-center p-7 rounded-2xl">
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->

        <form action="/" method="GET"> @csrf <button>Dashboard</button> </form>

        <form action="/product_management" method="GET"> @csrf <button>Product Management</button> </form>

        <form action="/user_management" method="GET"> @csrf <button>User Management</button> </form>

        <form action="/logout" method="POST"> @csrf <button>Log Out</button> </form>
    </div>
    @else
        
    @endauth
</header>
