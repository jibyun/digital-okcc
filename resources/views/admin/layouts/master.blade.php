<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags --}}

        <meta name="description" content="OKCC Cloud Office">
        <meta name="author" content="IT team of Ottawa Korean Community Church">
        <link rel="icon" href="{{ asset('images/favicon.ico') }}">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Application Name') }}</title>

        {{-- Basic Styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- Latest compiled and minified CSS for Bootstrap Table --}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
        {{-- Font awesome CSS --}}
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required. https://github.com/CodeSeven/toastr --}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        {{-- Custom styles for this template --}}
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
        {{-- for additional styles --}}
        @yield('styles')
    </head>
    <body style="height: 100%">

        @include('admin.layouts.header')
        @include('admin.layouts.side')
        @include('layouts.footer')

        {{-- Basic Scripts --}}
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/admin.js') }}" defer></script>
        {{-- Using Laravel localization with JavaScript and VueJS https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
             I just need to pull this route in our HTML to make this object globally visible --}}
        <script src="/js/lang.js"></script>
        {{-- Latest compiled and minified JavaScript, Locales for Bootstrap Table --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
        {{-- jQuery idle timer --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-idletimer/1.0.0/idle-timer.min.js"></script>
        {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required. https://github.com/CodeSeven/toastr --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        {{-- for additional scripts --}}
        @yield('scripts')

        <script>
            // Session timeout
            $.idleTimer( '{{ config('session.lifetime') }}' * 60 * 1000 );
            $( document ).bind( "idle.idleTimer", function(event, elem, obj){
                window.location.href = '{{ url('/login') }}';
            }); 

            // Get roles for current user
            @auth
                var roles = "{{ Auth::user()->roles() }}";
                var USER_ROLES = JSON.parse(roles.replace(/&quot;/g, '"'));
            @else
                var USER_ROLES = '';
            @endauth

            // Check if URL includes menu string
            function menu( $menuStr = '/' ) {
                return window.location.pathname.includes( $menuStr );
            }

            // Callback: create side menu
            var getSideMenuItem = function ( itemData ) {
                var item = $("<li>").append(
                    $("<a>", {
                        'href': (itemData.route) ? itemData.route : '#' + itemData.text,
                        'html': '<i class="fa fa-fw ' + itemData.icon + ' mr-1"></i>' + itemData.text,
                        'data-toggle': (itemData.sub_menu) ? 'collapse' : '',
                    })
                );
                if ( itemData.sub_menu ) {
                    var subList = $("<ul>").attr('id', itemData.text).attr('aria-expanded', false).addClass('list-unstyled collapse');
                    itemData.isOpened ? subList.addClass('show') : '';
                    $.each( itemData.sub_menu, function ( index, submenu ) {
                        subList.append( getSideMenuItem( submenu ) );
                    });
                    item.append(subList);
                } else {
                    if (itemData.route) {
                        urlRoute = itemData.route.replace(/^https?:\/\//,'');
                        urlPage = location.href.replace(/^https?:\/\//,'');
                        if (urlRoute == urlPage) {
                            item.addClass('active');
                        }
                    }
                    if(!USER_ROLES.includes(itemData.roles)) {
                        item.hide();
                    }
                }
                return item;
            };

            // Callback: create top menu
            var getTopMenuItem = function ( key, itemData ) {
                if(typeof USER_ROLES !== 'undefined' !== undefined && USER_ROLES.includes(itemData.roles) === true) {
                    const item = $("<li class='nav-item rounded px-2'>").append(
                        $("<a>", {
                            'class': 'nav-link',
                            'href': (itemData.route) ? itemData.route : '#' + itemData.text,
                            'html': itemData.text,
                        })
                    );
                    item.attr('name', key);
                    if ( menu(key) ) { 
                        item.addClass( 'active' ); 
                        // Create Side menu
                        const $sidemenu = $("#sidemenu");
                        $sidemenu.append( getSideMenuItem( itemData ) ); // create TOP menu of header
                    }
                    return item;
                } else {
                    return;
                }
            };

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({ dataType: 'json', timeout: 3000, url: "{!! route('admin.getmenu') !!}" })
            .done ( function(data, textStatus, jqXHR) { 
                const $top = $("#topMenu");
                $.each( data.menu, function ( index, top ) {
                    $top.append( getTopMenuItem( top.key, top.data[0] ) ); // create TOP menu of header
                });
                // toggle sidebar when button clicked
                $('.sidebar-toggle').on('click', function () {
                    $('.sidebar').toggleClass('toggled');
                });
            }) 
            .fail ( function(jqXHR, textStatus, errorThrown) { 
                errorMessage( jqXHR );
            });
        </script>
    </body>
</html>