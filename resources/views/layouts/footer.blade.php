@auth
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
@else
<nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="position:fixed;bottom:0;right:0;width:100%;">
@endauth    
    <div class="container-fluid justify-content-end">
        {{-- Reference of Copyright Notice: https://webmasters.stackexchange.com/questions/76905/how-should-copyright-notices-be-formatted-on-websites --}}
        <a href="javascript:void(0)" class="contact-email"><i class="fa fa-envelope-o mr-2"></i><span class='mr-2' style="font-size: 0.8em; color:orange">@lang('messages.adm_layout.contact')</span></a>|
        <span class='ml-2' style="font-size: 0.8em">@lang('messages.adm_layout.copyright2018')</span>
    </div>
</nav>
@include('admin.includes.contact')