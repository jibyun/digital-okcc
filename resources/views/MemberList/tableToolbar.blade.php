{{-- Table Toolbar --}}
<div id="member_table_toolbar" class="form-inline hide">
    {{-- 회원구분 combobox --}}
    <select id='cmbMemberStatus' class="form-control mr-2">
    </select>
    {{-- Email Button --}}
    <button id="btnSendEmail" class="btn mr-2" type="button">
        <i class="fa fa-fw fa-envelope mr-1" aria-hidden="true"></i>{{ __('messages.memberlist.toolbar_email') }}
    </button>
    {{-- Excel Export button--}}
    <button id="btnSaveAsExcel" class="btn mr-2" type="button" data-toggle="modal" 
        data-target="#exportDialog" data-backdrop="static">
        <i class="fa fa-fw fa-download mr-1" aria-hidden="true"></i>{{ __('messages.memberlist.toolbar_saveexcel') }}
    </button>
</div>