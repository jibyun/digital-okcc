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
            <li style="padding: 15px;">
                @yield('sidePanel')
            </li>
        </ul>
        @endauth
    </nav>
    <div class="container-fluid" style="margin: 15px 30px;">
        @yield('content')
    </div>
</div>