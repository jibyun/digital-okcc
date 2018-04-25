@auth
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
@else
<nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="position:fixed;bottom:0;right:0;width:100%;">
@endauth    
    <div class="container-fluid justify-content-end">
        {{-- Reference of Copyright Notice: https://webmasters.stackexchange.com/questions/76905/how-should-copyright-notices-be-formatted-on-websites --}}
        <a href="#" class=""><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;<span style="font-size: 0.8em; color:orange">Contact to Admin</span></a>&nbsp;&nbsp;|&nbsp;&nbsp;
        <span style="font-size: 0.8em">Copyright &copy; 2018 Ottawa Korean Community Church</span>
    </div>
</nav>