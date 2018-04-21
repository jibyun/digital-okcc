<div class="d-flex" style="font-family: 'Roboto', 'Nanum Gothic', sans-serif;">
    <nav class="sidebar">
        <ul class="list-unstyled">
            <li style="padding: 15px;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by Name" aria-label="Search" aria-describedby="Search by name">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </li>
            {{-- Side menu for Users --}}
            <li>
                <a href="#users" data-toggle="collapse"><i class="fa fa-fw fa-user"></i> Users</a>
                <ul id="users" class="list-unstyled collapse show">
                    <a href="#users_privilege" data-toggle="collapse"><i class="fa fa-fw fa-eye"></i> Privileges & Roles</a>
                    <ul id="users_privilege" class="list-unstyled collapse show">
                        <li><a href="{{ route('admin.privileges.start') }}"><i class="fa fa-fw fa-plug"></i> Privileges</a></li>
                        <li><a href="{{ route('admin.roles.start') }}"><i class="fa fa-fw fa-plug"></i> Roles</a></li>
                        <li><a href="{{ route('admin.privileges-roles.map') }}"><i class="fa fa-fw fa-plug"></i> Privileges > Roles</a></li>
                    </ul>
                    <li><a href="{{ route('admin.users.regist') }}"><i class="fa fa-fw fa-registered"></i> User Registration</a></li>
                    <li><a href="{{ route('admin.log.view') }}"><i class="fa fa-fw fa-file-text-o"></i> Log View</a></li>
                </ul>
            </li>
            {{-- Side menu for Members --}}
            <li>
                <a href="#members" data-toggle="collapse"><i class="fa fa-fw fa-users"></i> Members</a>
                <ul id="members" class="list-unstyled collapse show">
                    <li><a href="{{ route('admin.categories.start') }}"><i class="fa fa-fw fa-list-alt"></i> Categories</a></li>
                    <li><a href="{{ route('admin.codes.start') }}"><i class="fa fa-fw fa-key"></i> Codes</a></li>
                    <li><a href="{{ route('admin.dept-tree.map') }}"><i class="fa fa-fw fa-link"></i> Department Tree</a></li>
                    <li><a href="{{ route('admin.members.start') }}"><i class="fa fa-fw fa-anchor"></i> Members</a></li>
                    <li><a href="{{ route('admin.family.map') }}"><i class="fa fa-fw fa-sitemap"></i> Family Tree</a></li>
                    <li><a href="{{ route('admin.member-dept.map') }}"><i class="fa fa-fw fa-files-o"></i> Member > Department</a></li>
                </ul>
            </li>
            <li>
                <a href="#finance" data-toggle="collapse"><i class="fa fa-fw fa-diamond"></i> Finance</a>
                <ul id="finance" class="list-unstyled collapse">

                </ul>
            </li>
            <li>
                <a href="#inventories" data-toggle="collapse"><i class="fa fa-fw fa-inbox"></i> Inventories</a>
                <ul id="inventories" class="list-unstyled collapse">

                </ul>
            </li>
        </ul>
    </nav>
    <div class="container-fluid" style="margin: 15px 30px;">
        @yield('content')
    </div>
</div>