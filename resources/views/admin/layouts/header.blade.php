{{-- Floating Top Button --}}
<button id="topButton" type="button" class="btn btn-primary btn-circle btn-lg" title="Go to top" onclick="topFunction()" style="display: none;"><i class="fa fa-arrow-up"></i></button>
{{-- Navigation Bar --}}
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div style="min-width:250px; max-width:250px;">
        <a class="sidebar-toggle text-light mr-3"><i class="fa fa-bars"></i></a>
        @if ( strpos(url()->current(), 'admin') !== false )
            <a class="navbar-brand" href="{{ URL::to('/') }}/admin"><i class="fa fa-code-branch"></i>{{ str_replace('Office', 'Admin', config('app.name', 'Application Name')) }}</a>
        @else
            <a class="navbar-brand" href="{{ URL::to('/') }}"><i class="fa fa-code-branch"></i>{{ config('app.name', 'Application Name') }}</a>
        @endif
    </div>
    {{-- Collapse 되었을 때 나타날 버튼 --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="#">Members</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Finance</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Inventories</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <i class="fa fa-user"></i>&nbsp&nbsp&nbspSteve Kim {{-- User 테이블에서 읽은 사람이름이 들어가는 곳 --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#"><i class="fa fa-sign-out fa-lg"></i>&nbsp&nbsp&nbsp Log Out</a>
                    {{-- After developed log out form, it should be used --}}
                    {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i>&nbsp&nbsp&nbsp{{ __('Log Out') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form> --}}
                </div>
            </li>
        </ul>
    </div>
</nav>