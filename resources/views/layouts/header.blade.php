<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="sidebar-toggle text-light mr-3"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="#"><i class="fa fa-code-branch"></i> OKCC Cloud Office</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav nav nav-pills nav-justified mr-auto" style="margin-left: 75px;">
            <li><a class="nav-item nav-link btn-width-100 active " href="#" style="background-color: #202020;">Member</a></li>
            <li><a class="nav-item nav-link btn-width-100 disabled" href="#">Finance</a></li>
            <li><a class="nav-item nav-link btn-width-100 disabled" href="#">Inventories</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <i class="fa fa-user"></i>&nbsp&nbsp&nbsp Steve Kim
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#"><i class="fa fa-sign-out fa-lg"></i>&nbsp&nbsp&nbsp Log Out</a>
                    {{-- After developed log out form, it should be used --}}
                    {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i>&nbsp&nbsp&nbsp{{ __('Log Out') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-question-circle-o fa-lg"></i>&nbsp&nbsp&nbsp About</a>
                </div>
            </li>
        </ul>
    </div>
</nav>