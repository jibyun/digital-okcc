<div class="d-flex">
    <nav class="sidebar bg-dark">
        @auth
        <ul class="list-unstyled">
            <li style="padding: 15px;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by Name" aria-label="Search" aria-describedby="Search by name">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </li>
            <li>
                <a href="#submenu_users" data-toggle="collapse"><i class="fa fa-fw fa-user"></i>&nbsp;&nbsp;Users</a>
                <ul id="submenu_users" class="list-unstyled collapse">
                    <li><a href="#">Approval</a></li>
                    <li><a href="#">Remove User</a></li>
                    <li><a href="#">Privileges</a></li>
                    <li><a href="#">Roles</a></li>
                    <li><a href="#">Visit History View</a></li>
                    <li><a href="#">Log View</a></li>
                </ul>
            </li>
            <li>
                <a href="#submenu_members" data-toggle="collapse"><i class="fa fa-fw fa-users"></i>&nbsp;&nbsp;Members</a>
                <ul id="submenu_members" class="list-unstyled collapse show">
                    <li><a href="#">Status (구분)</a></li>
                    <li><a href="#">Level (신급)</a></li>
                    <li><a href="#">Duty (직분)</a></li>
                    <li><a href="#">Position (직책)</a></li>
                    <li><a href="#">Department (부서)</a></li>
                    <li><a href="#">Delete Member</a></li>
                </ul>
            </li>
            <li>
                <a href="#submenu_finance" data-toggle="collapse"><i class="fa fa-fw fa-diamond"></i>&nbsp;&nbsp;Finance</a>
                <ul id="submenu_finance" class="list-unstyled collapse">
                    <li><a href="#">Account Code</a></li>
                    <li><a href="#">Ledger</a></li>
                    <li><a href="#">Cash Book</a></li>
                </ul>
            </li>
            <li>
                <a href="#submenu_inventories" data-toggle="collapse"><i class="fa fa-fw fa-inbox"></i>&nbsp;&nbsp;Inventories</a>
                <ul id="submenu_inventories" class="list-unstyled collapse">
                    <li><a href="#">Item</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-fw fa-link"></i>&nbsp;&nbsp;Go To OCO</a></li>
        </ul>
        @endauth
    </nav>
    <div class="container-fluid" style="margin: 15px 30px;">
        @yield('content')
    </div>
</div>