<div id="divMemberSubInfo">
    <div id="divBasic" >
      <div id="divFamilys">
        <span>Family : </span>
        <span id="spanFamilys"></span>
        @include ('MemberList.memberBasicInfoDialog')
      </div>
      <br/>
      <div id="divWorks" style="display:inline-block">
          <span>Works :</span>
           <span id="spanWorks"></span>
      </div>
        
    </div>
  
    <div id="divHistory" style="display:none;">
        <h6>History</h6>
      @include ('MemberList.memberHistoryDialog')
      @include ('MemberList.memberHistoryToolbar')
      <table id="history_table"></table>
    </div>
  
    <div id="divVisit" style="display:none">
        <h6>Visit</h6>
      @include ('MemberList.memberVisitDialog')
      @include ('MemberList.memberVisitToolbar')
      <table id="visit_table"></table>
    </div>
    
  </div>

</div>

{{-- <div id="tabs">
  <ul>
    <li><a href="#tabs-basic" id="basicTab">Basic</a></li>
    <li><a href="#tabs-history" id="historyTab">History</a></li>
    <li><a href="#tabs-visit" id="visitTab">Pastor Visit</a></li>
  
  </ul>
  <div id="tabs-basic">
    <div>
      <h6>Family</h6>
        <table id="family_table"></table>
    </div>
    <br/>
    <div>
        <h6>Works</h6>
          <table id="work_table"></table>
      </div>
      
  </div>

  <div id="tabs-history">
    @include ('MemberList.memberHistoryDialog')
    @include ('MemberList.memberHistoryToolbar')
    <table id="history_table"></table>
  </div>

  <div id="tabs-visit">
    @include ('MemberList.memberVisitDialog')
    @include ('MemberList.memberVisitToolbar')
    <table id="visit_table"></table>
  </div>
  
</div> --}}
