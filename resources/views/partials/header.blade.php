<div class="navbar mb-2 shadow-lg bg-neutral text-neutral-content flex-col md:flex-row">
    <div class="flex-none px-2 mx-2">
        <span class="text-2xl font-bold">
            <p class="text-primary">Windblade</p>
        </span>
    </div>

    <div class="flex-1 px-2 mx-2">
        <div class="items-stretch flex">
            <div class="dropdown dropdown-end">
                <div tabindex="0" class="m-1 btn btn-primary btn-sm text-xs md:text-base">Management</div>
                <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-primary rounded-box w-52">
                    <li><a href="/dashboard" class="btn btn-primary btn-sm rounded-btn h-full"> Dashboard </a></li>
                    <li><a href="/outlets" class="dropdown-btn"> Outlet Management </a></li>
                    <li><a href="/packages" class="dropdown-btn"> Package Management </a></li>
                    <li><a href="/customers" class="dropdown-btn"> Customer Management </a></li>
                    <li><a class="dropdown-btn"> User Management </a></li>
                    <li><a class="dropdown-btn"> Transactions </a></li>
                    <li><a class="dropdown-btn"> Reports </a></li>
                    <li class="flex md:hidden"><a href="" class="dropdown-btn"> Account </a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="flex-none hidden md:flex">
        <div class="dropdown dropdown-end">
        <div tabindex="0" class="m-1 btn btn-primary btn-sm text-xs md:text-base">{{ Auth::user()->name }}</div>
            
            <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-secondary rounded-box w-52">
                <a class="dropdown-btn my-1">Profile</a>
                <a href="/logout" class="dropdown-btn my-1">Logout</a>
            </ul>
        </div>
    </div>
</div>