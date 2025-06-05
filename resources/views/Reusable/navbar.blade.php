<header class="flex border-b-2 flex-wrap sm:justify-start sm:flex-nowrap w-full pb-3 bg-gray-200">

    @auth
    <nav class='max-w-[100rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between'>
            <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
            <h2 class='flex items-center gap-5 mt-5 pb-2 space-x-3 rtl:space-x-reverse'>Welcome <?php echo Auth::user()->name; ?>!</h2>

            <div class="flex flex-row items-center gap-5 mt-5 pb-2  sm:justify-end">

                <a href='/'>Dashboard</a>
                <a href='/product_management'>Product Management</a>

                <a href='/user_management'>User Management</a>

                <a href='/sale_management'>Sale Management</a>

                <a href='/report_management'>Report Management</a>

                <form action="/logout" method="POST"> @csrf <button>Log Out</button> </form>
                
            </div>
        </div>
    </nav>
    @else
    <h2>Welcome Guest!</h2>
        
    @endauth
</header>
