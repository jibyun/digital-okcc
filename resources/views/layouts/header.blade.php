{{-- Floating Top Button --}}
<button id="topButton" type="button" class="btn btn-primary btn-circle btn-lg" title="Go to top" onclick="topFunction()" style="display: none;"><i class="fa fa-arrow-up"></i></button>
{{-- Navigation Bar --}}
<nav class="navbar navbar-dark bg-dark navbar-expand-lg sticky-top">
    <div style="min-width:250px; max-width:250px;">
        @auth
        <a class="sidebar-toggle text-light mr-3"><i class="fa fa-bars"></i></a>
        @endauth
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
    @auth
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul id="topMenu" class="navbar-nav mr-auto">

        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <i class="fa fa-fw fa-user mr-1"></i>{{ Auth::user()->name }}
                </a>
                <div id="userDropdownMenu" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    @if ( strpos(url()->current(), 'admin') !== false )
                        <a href="/" class="dropdown-item"><i class="fa fa-fw fa-cog fa-lg mr-1"></i>{{ trans('messages.adm_layout.goback_home') }}</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('changePasswordForm') }}">
                        <i class="fa fa-key fa-lg mr-2"></i>@lang('messages.auth.changepassword')
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-sign-out fa-lg mr-1"></i>{{ trans('messages.adm_button.logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </li>
        </ul>
    </div>
    @endauth 
</nav>
@include ('MemberList.confirmDialog')