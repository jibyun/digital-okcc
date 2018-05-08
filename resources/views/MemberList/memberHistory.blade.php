<div>
    {{--Display member name (english + Korean)--}}
    <div id="member_history_toolbar">
        {{--Toolbar add/delete --}}
        {{-- Add new history button --}}
        <button id="btnCreateHistory" class="btn mr-2" type="button" data-toggle="modal" 
            data-backdrop="static" data-target="#memberHistoryDialog">
            <i class="fa fa-fw fa-envelope mr-1" aria-hidden="true"></i>{{ __('messages.memberlist.toolbar_email') }}
        </button>
        {{-- Delete History button--}}
        <button id="btnSaveAsExcel" class="btn mr-2" type="button" data-toggle="modal" data-target="#exportDialog">
            <i class="fa fa-fw fa-download mr-1" aria-hidden="true"></i>{{ __('messages.memberlist.toolbar_saveexcel') }}
        </button>
    </div>
    <div id="member_history_table">
        {{--Table to display member history--}}
        <table id="history_table"></table>
    </div>
    @include ('MemberList.memberHistoryDialog')
</div>

