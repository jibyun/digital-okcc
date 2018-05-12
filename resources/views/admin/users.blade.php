@extends('admin.layouts.master')

@section('content')
<div style="margin: -15px -45px;">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron jumbotron-fluid" style="background-color: #2196f3; color: whitesmoke;">
        <div class="container">
            <p><span class="h1-font-size">{{ trans('messages.adm_layout.header_menu_user') }}</p>
            <p class="lead text-justify">{{ trans('messages.adm_layout.message_user') }}</p>
            <p style="color: orange">{{ trans('messages.adm_layout.passage_user') }}</p>
        </div>
    </div>
</div>
@endsection
