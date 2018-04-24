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
    <body>

        @include('admin.layouts.header')
        @include('admin.layouts.side')
        @include('layouts.footer')

        {{-- Basic Scripts --}}
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- Basic Scripts --}}
        <script src="{{ asset('js/admin.js') }}"></script>

        {{-- Latest compiled and minified JavaScript, Locales for Bootstrap Table --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>

        {{-- jQuery plugin to export a html table to JSON, XML, CSV, TSV, TXT, SQL, Word, Excel, PNG and PDF https://github.com/hhurz/tableExport.jquery.plugin --}}
        {{-- To save the generated export files on client side, include in your html code: --}}
        <script type="text/javascript" src="{{ asset('js/exportPlugins/FileSaver/FileSaver.min.js') }}"></script>
        {{-- To export the table in XLSX (Excel 2007+ XML Format) format, you need to include additionally: --}}
        <script type="text/javascript" src="{{ asset('js/exportPlugins/js-xlsx/xlsx.core.min.js') }}"></script>
        {{-- To export the table as a PDF file the following includes are required: --}}
        <script type="text/javascript" src="{{ asset('js/exportPlugins/jsPDF/jspdf.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/exportPlugins/jsPDF-AutoTable/jspdf.plugin.autotable.js') }}"></script>
        {{-- <script type="text/javascript" src="tableExport.min.js"></script> --}}
        <script type="text/javascript" src="{{ asset('js/tableExport.min.js') }}"></script>
        
        {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required. https://github.com/CodeSeven/toastr --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        {{-- for additional scripts --}}
        @yield('scripts')
    </body>
</html>