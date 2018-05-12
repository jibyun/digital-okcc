<div id="tabs">
  <ul>
    <li><a href="#tabs-family" id="familyTab">Family</a></li>
    <li><a href="#tabs-history" id="historyTab">History</a></li>
    <li><a href="#tabs-visit" id="visitTab">Pastor Visit</a></li>
    <li><a href="#tabs-work" id="workTab">Works</a></li>
  </ul>
  <div id="tabs-family">
  </div>

  <div id="tabs-history">
    @include ('MemberList.memberHistoryDialog')
    @include ('MemberList.memberHistoryToolbar')
    <table id="history_table"></table>
  </div>

  <div id="tabs-visit">
  </div>
  <div id="tabs-work">
    <ul>
      <li>There is no Data</li>
    </ul>
  </div>
</div>
