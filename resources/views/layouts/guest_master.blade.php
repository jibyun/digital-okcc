<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags --}}

        <meta name="description" content="{{ config('app.name', 'Application Name') }}">
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
        {{-- Custom styles for this template --}}
        <link href="{{ asset('css/okcc.css') }}" rel="stylesheet">

        {{-- for additional styles --}}
        @yield('styles')
    </head>
    <body>
  
    {{-- Navigation Bar --}}
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <div style="min-width:250px; max-width:250px;">
               
                <a class="navbar-brand" href="/"><i class="fa fa-code-branch"></i>{{ config('app.name', 'Application Name') }}</a>
            </div>

        </nav>

        <div style="min-height:100%;margin-bottom:100px;";>
        @yield('content')
        </div>

        <nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="position:fixed;bottom:0;right:0;width:100%;">
		<div class="container-fluid justify-content-end">
        {{-- Reference of Copyright Notice: https://webmasters.stackexchange.com/questions/76905/how-should-copyright-notices-be-formatted-on-websites --}}
        <a href="#" class=""><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;<span style="font-size: 0.8em; color:orange">Contact to Admin</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <span style="font-size: 0.8em">Copyright &copy; 2018 Ottawa Korean Community Church</span>
		 </div>
		</nav>

        
        {{-- Basic Scripts --}}
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- Basic Scripts --}}
        <script src="{{ asset('js/okcc.js') }}"></script>
        {{-- Latest compiled and minified JavaScript, Locales for Bootstrap Table --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>
        {{-- for additional scripts --}}
        @yield('scripts')
    </body>
</html>