<div class="d-flex">
    <nav class="sidebar">
        <ul class="list-unstyled">
            {{-- Side menu for Members --}}
            <li>
                <a href="#members" data-toggle="collapse"><i class="fa fa-fw fa-users mr-1"></i>{{ __('messages.adm_layout.header_menu_member') }}</a>
                <ul id="members" class="list-unstyled collapse show">
                    <li><a href="{{ route('admin.categories.start') }}"><i class="fa fa-fw fa-list-alt mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Category']) }}</a></li>
                    <li><a href="{{ route('admin.codes.start') }}"><i class="fa fa-fw fa-key mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Code']) }}</a></li>
                    <li><a href="{{ route('admin.dept-tree.map') }}"><i class="fa fa-fw fa-link mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Department Tree']) }}</a></li>
                    <li><a href="{{ route('admin.members.start') }}"><i class="fa fa-fw fa-anchor mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Member']) }}</a></li>
                    <li><a href="{{ route('admin.family.map') }}"><i class="fa fa-fw fa-sitemap mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Family Tree']) }}</a></li>
                    <li><a href="{{ route('admin.member-dept.map') }}"><i class="fa fa-fw fa-files-o mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Department Enrollment']) }}</a></li>
                    <li><a href="{{ route('admin.cell.orginizer') }}"><i class="fa fa-fw fa-cubes mr-1"></i>{{ __('messages.adm_title.cell_organizer') }}</a></li>
                    <li><a href="{{ route('admin.dept.orginizer') }}"><i class="fa fa-fw fa-cubes mr-1"></i>{{ __('messages.adm_title.dept_organizer') }}</a></li>
                </ul>
            </li>
            {{-- Side menu for Users --}}
            <li>
                <a href="#users" data-toggle="collapse"><i class="fa fa-fw fa-user mr-1"></i>{{ __('messages.adm_layout.side_users') }}</a>
                <ul id="users" class="list-unstyled collapse show">
                    <a href="#users_privilege" data-toggle="collapse"><i class="fa fa-fw fa-eye mr-1"></i>{{ __('messages.adm_layout.side_pri_role') }}</a>
                    <ul id="users_privilege" class="list-unstyled collapse show">
                        <li><a href="{{ route('admin.privileges.start') }}"><i class="fa fa-fw fa-angle-right mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Privilege']) }}</a></li>
                        <li><a href="{{ route('admin.roles.start') }}"><i class="fa fa-fw fa-angle-right mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Role']) }}</a></li>
                        <li><a href="{{ route('admin.privileges-roles.map') }}"><i class="fa fa-fw fa-angle-right mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Privilege Mapping']) }}</a></li>
                    </ul>
                    <li><a href="{{ route('admin.users.regist') }}"><i class="fa fa-fw fa-registered mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'User']) }}</a></li>
                    <li><a href="{{ route('admin.log.view') }}"><i class="fa fa-fw fa-file-text-o mr-1"></i>{{ __('messages.adm_title.title', ['title' => 'Log']) }}</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="container-fluid" style="margin: 15px 30px;">
        @yield('content')
    </div>
</div>