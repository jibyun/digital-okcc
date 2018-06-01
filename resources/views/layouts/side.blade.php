@auth
<div class="d-flex">
    <nav class="sidebar bg-dark">
        <ul class="list-unstyled">
            <li>
                <div class="input-group">
                    <input id="inputSearch" type="text" class="form-control" placeholder="Search by Name" aria-label="Search" aria-describedby="Search by name">
                    <div class="input-group-append">
                        <button id="btnSearch" class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </li>
            <li>
                @yield('sidePanel')
            </li>
        </ul>
    </nav>
    <div class="container-fluid" style="margin: 15px 30px;">
        @yield('content')
    </div>
</div>
@else
<div style="min-height:100%;margin-bottom:100px;">
    @yield('content')
</div>
@endauth