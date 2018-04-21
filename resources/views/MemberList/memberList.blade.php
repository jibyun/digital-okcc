@extends('layouts.master')
@section('styles')
<link href="{{ asset('css/gj-tree.css') }}" rel="stylesheet">
@endsection

@section('sidePanel')
<div id="sideMenuCategory">
</div>
<div id="sideMenuMemberDetail" style="display: none;">
    <ul id="menu_member_detail_basic" class="memberDetail list-unstyled collapse show">{{__('messages.memberdetail.menu_basicinfo')}}</ul>
    <ul id="menu_member_detail_history" class="memberDetail list-unstyled collapse show">{{__('messages.memberdetail.menu_history')}}</ul>
    <ul id="menu_member_detail_visit" class="memberDetail list-unstyled collapse show">{{__('messages.memberdetail.menu_visit')}}</ul>
</div>
<div id="sideMenuProfile" style="display: none;">
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
