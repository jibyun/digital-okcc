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
                <a href="#users" data-toggle="collapse"><i class="fa fa-fw fa-user mr-1"></i>{{ __('messages.adm_layout.side_users') }}</a>
                <ul id="users" class="list-unstyled collapse show">
                    <a href="#users_privilege" data-toggle="collapse"><i class="fa fa-fw fa-eye mr-1"></i>{{ __('messages.adm_layout.side_pri_role') }}</a>
                    <ul id="users_privilege" class="list-unstyled collapse show">
                        <li><a href="{{ route('admin.privileges.start') }}"><i class="fa fa-fw fa-plug mr-1"></i>{{ __('messages.adm_layout.side_privilege') }}</a></li>
                        <li><a href="{{ route('admin.roles.start') }}"><i class="fa fa-fw fa-plug mr-1"></i>{{ __('messages.adm_layout.side_role') }}</a></li>
                        <li><a href="{{ route('admin.privileges-roles.map') }}"><i class="fa fa-fw fa-plug mr-1"></i>{{ __('messages.adm_layout.side_p_role') }}</a></li>
                    </ul>
                    <li><a href="{{ route('admin.users.regist') }}"><i class="fa fa-fw fa-registered mr-1"></i>{{ __('messages.adm_layout.side_regstration') }}</a></li>
                    <li><a href="{{ route('admin.log.view') }}"><i class="fa fa-fw fa-file-text-o mr-1"></i>{{ __('messages.adm_layout.side_logview') }}</a></li>
                </ul>
            </li>
            {{-- Side menu for Members --}}
            <li>
                <a href="#members" data-toggle="collapse"><i class="fa fa-fw fa-users mr-1"></i>{{ __('messages.adm_layout.header_menu_member') }}</a>
                <ul id="members" class="list-unstyled collapse show">
                    <li><a href="{{ route('admin.categories.start') }}"><i class="fa fa-fw fa-list-alt mr-1"></i>{{ __('messages.adm_layout.side_category') }}</a></li>
                    <li><a href="{{ route('admin.codes.start') }}"><i class="fa fa-fw fa-key mr-1"></i>{{ __('messages.adm_layout.side_code') }}</a></li>
                    <li><a href="{{ route('admin.dept-tree.map') }}"><i class="fa fa-fw fa-link mr-1"></i>{{ __('messages.adm_layout.side_d_tree') }}</a></li>
                    <li><a href="{{ route('admin.members.start') }}"><i class="fa fa-fw fa-anchor mr-1"></i>{{ __('messages.adm_layout.side_member') }}</a></li>
                    <li><a href="{{ route('admin.family.map') }}"><i class="fa fa-fw fa-sitemap mr-1"></i>{{ __('messages.adm_layout.side_family_tree') }}</a></li>
                    <li><a href="{{ route('admin.member-dept.map') }}"><i class="fa fa-fw fa-files-o mr-1"></i>{{ __('messages.adm_layout.side_m_dept') }}</a></li>
                </ul>
            </li>
            <li>
                <a href="#finance" data-toggle="collapse"><i class="fa fa-fw fa-diamond mr-1"></i>{{ __('messages.adm_layout.header_menu_finance') }}</a>
                <ul id="finance" class="list-unstyled collapse">

                </ul>
            </li>
            <li>
                <a href="#inventories" data-toggle="collapse"><i class="fa fa-fw fa-inbox mr-1"></i>{{ __('messages.adm_layout.header_menu_inventory') }}</a>
                <ul id="inventories" class="list-unstyled collapse">

                </ul>
            </li>
        </ul>
    </nav>
    <div class="container-fluid" style="margin: 15px 30px;">
        @yield('content')
    </div>
</div>