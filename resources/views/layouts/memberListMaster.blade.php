@extends('layouts.master')
@section('side')
    @include('layouts.side')
@endsection
@section('masterScripts')
<script>
    // Getting the menu
    restApiCall("{!! route('getmenu') !!}" + "?id=memberList", "GET", null, menuSuccess, menuFailure);
</script>
@endsection