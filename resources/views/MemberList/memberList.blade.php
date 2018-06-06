@extends('layouts.memberListMaster')
@section('styles')
<link href="{{ asset('css/gj-tree.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{-- chosen user interface for autocomplete input --}}
    <link href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
    {{-- Croppie is a fast, easy to use image cropping plugin with tons of configuration options! https://foliotek.github.io/Croppie/ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css" />
    {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required. https://github.com/CodeSeven/toastr --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
<script src="{{ asset('js/MemberList/memberList.js') }}"></script>
<script src="{{ asset('js/MemberList/memberDetail.js') }}"></script>
<script src="{{ asset('js/MemberList/memberHistory.js') }}"></script>
<script src="{{ asset('js/MemberList/memberVisit.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.collapse').on('show.bs.collapse', function() {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-faq');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-minus"></i>');
    });
    $('.collapse').on('hide.bs.collapse', function() {
        var id = $(this).attr('id');
        $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-faq');
        $('a[href="#' + id + '"] .panel-title span').html('<i class="glyphicon glyphicon-plus"></i>');
    });
});
</script>
    {{-- chosen user interface CDN for autocomplete input --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>

    {{-- Tempus Dominus Bootstrap 4: The plugin provide a robust date and time picker designed to integrate into your Bootstrap project. https://tempusdominus.github.io/bootstrap-4/ --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

    {{-- Croppie is a fast, easy to use image cropping plugin with tons of configuration options! https://foliotek.github.io/Croppie/ --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
@endsection
