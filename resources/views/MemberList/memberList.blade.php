@extends('layouts.master')
@section('styles')
<link href="{{ asset('css/gj-tree.css') }}" rel="stylesheet">
@endsection

@section('sidePanel')
<div id="sideMenu">
</div>
@endsection

@section('content')
@include('MemberList.mainPanel')
@endsection

@section('scripts')
<script>
    {{--TODO AuthTest It will be removed 
    var AuthUser = "{{{ (Auth::user()) ? Auth::user()->name : null }}}";
    var AuthUser1 = "{{ Auth::user()->name }}";
    var AuthUser2 = "{{ Auth::user()->name }}";
    var AuthUser3 = "{{ Auth::user()->user_privilege_maps }}";
    var AuthUser4 = "{{{ (Auth::user())->email }}}";
    --}}
</script>
<script src="{{ asset('js/MemberList/memberList.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
@endsection
