@extends('layouts.master')
@section('side')
@include('admin.layouts.side')
@endsection
@section('masterScripts')
<script src="{{ asset('js/admin.js') }}" defer></script>
<script>
    // Getting the admin menu
    restApiCall("{!! route('getmenu') !!}" + "?id=admin", "GET", null, menuSuccess, menuFailure);
</script>
@endsection