<header class="flex border-b-2 flex-wrap sm:justify-start sm:flex-nowrap w-full pb-3 bg-gray-200">
    @auth
    <nav class='max-w-[100rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between'>
            <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
            <h2 class='flex items-center gap-5 mt-5 pb-2 space-x-3 rtl:space-x-reverse'>Welcome <?php echo Auth::user()->name; ?>!</h2>

            <div class="flex flex-row items-center gap-5 mt-5 pb-2 sm:justify-end">

                <a href='/'>Dashboard</a>

                <div class="dropdown group">
                    <a href='/product_management' id='product_management'>Product Management</a>

                    <div class="dropdown-content">
                        <a href="/product_management/create_product">Create Product</a>
                        <a href="/product_management/category/create_category">Create Category</a>
                        <a href="/product_management/supplier/create_supplier">Create Supplier</a>
                        <a href="/product_management/order/create_order">Create Order</a>
                    </div>
                </div>

                <div class="dropdown group">
                    <a href='/user_management' id='user_management'>User Management</a>
                </div>

                <div class="dropdown group">
                    <a href='/sale_management' id='sale_management'>Sale Management</a>

                    <div class="dropdown-content">
                        <a href="/sale_management/create_sale">Create Sale</a>
                    </div>
                </div>


                <div class="dropdown group">
                    <a href='/report_management' id='report_management'>Report Management</a>
                </div>

                <form action="/logout" method="POST"> @csrf <button>Log Out</button> </form>
                
            </div>
        </div>
    </nav>
    @else
    <h2>Welcome Guest!</h2>
    @endauth
</header>
