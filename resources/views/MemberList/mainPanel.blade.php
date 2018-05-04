<div id="divMainPanel">
{{--TODO: We will add contents here--}}
{{-- page title --}}
    <div id="pageTitle" class="card bg-info text-white text-center h3 p-2">
        {{__('messages.memberlist.landingtitle')}}
    </div>
{{-- Landing Page Content --}}
    <div id="LandingContent" class="card-block p-4"></div>
{{-- Main Page Content --}}
    <div id="MainContent" class="card-block">
    {{-- Header section --}}
        <div id="mc_header">@include('MemberList.headerPanel')</div>
    {{-- Toolbar section --}}
        <div id="mc_toolbar" >@include('MemberList.tableToolbar')</div>
        @include ('MemberList.exportDialog')
    {{-- Table section --}}
        <div id="mc_table">
            <table id="bt_table"></table>
        </div>
    {{-- Table section --}}
        <div id="mc_footer"></div>
    </div>
</div>

<div id="divMemberDetailPanel" style="display:none">
        @include('MemberList.memberShowPanel')
    <div id="divMemberSubDetailPanel" >
            @include('MemberList.memberSubPanel')
     </div>
   
</div>
