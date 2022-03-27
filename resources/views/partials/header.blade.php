<div class="navbar mb-2 shadow-lg bg-neutral text-neutral-content flex-col md:flex-row non-printable">
    <div class="flex-none px-2 mx-2">
        <span class="text-2xl font-bold">
            <p class="text-primary">Windblade</p>
        </span>
    </div>

    <div class="flex-1 px-2 mx-2">
        <div class="items-stretch flex">
            <div class="dropdown">
                <div tabindex="0" class="m-1 btn btn-primary btn-sm text-xs md:text-base">Management</div>
                <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-primary rounded-box w-72">
                    <li><a href="/dashboard" class="btn btn-primary btn-sm rounded-btn h-full"> Dashboard </a></li>
                    @if (Auth::user()->roles == 'ADMIN')
                        <li><a href="/outlets" class="dropdown-btn"> Outlet Management </a></li>
                        <li><a href="/packages" class="dropdown-btn"> Package Management </a></li>
                        <li><a href="/customers" class="dropdown-btn"> Customer Management </a></li>
                        <li><a href="/users" class="dropdown-btn"> User Management </a></li>
                        <li><a href="/inventory" class="dropdown-btn"> Inventory Management </a></li>
                        <li><a href="/transactions" class="dropdown-btn"> Transactions </a></li>
                        <li>
                            <a href="{{ route('view_simulated_transaction') }}" class="dropdown-btn"> Simulated
                                Transactions
                            </a>
                        </li>
                        <li><a href="/delivery" class="dropdown-btn"> Delivery </a></li>
                        <li><a href="/items" class="dropdown-btn"> Items </a></li>
                        <li><a href="/invoices" class="dropdown-btn"> Invoices </a></li>
                        <li><a href="/reports" class="dropdown-btn"> Reports </a></li>
                    @endif

                    @if (Auth::user()->roles == 'OWNER')
                        <li><a href="{{ route('salary') }}" class="dropdown-btn"> Salary </a></li>
                        <li><a href="{{ route('reports') }}" class="dropdown-btn"> Reports </a></li>
                    @endif

                    @if (Auth::user()->roles == 'CASHIER')
                        <li><a href="/transactions" class="dropdown-btn"> Transactions </a></li>
                        <li>
                            <a href="{{ route('view_simulated_transaction') }}" class="dropdown-btn"> Simulated
                                Transactions
                            </a>
                        </li>
                        <li><a href="/invoices" class="dropdown-btn"> Invoices </a></li>
                        <li><a class="dropdown-btn"> Reports </a></li>
                    @endif


                    <li class="flex md:hidden"><a href="/profile" class="dropdown-btn"> Account </a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="flex-none hidden md:flex">
        <div class="dropdown dropdown-end">
            <div tabindex="0" class="m-1 btn btn-primary btn-sm text-xs md:text-base">
                {{ Auth::user()->name }}
            </div>

            <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-primary rounded-box w-52">
                <a class="dropdown-btn my-1">Profile</a>
                <a href="/logout" class="dropdown-btn my-1">Logout</a>
            </ul>
        </div>
    </div>
</div>
