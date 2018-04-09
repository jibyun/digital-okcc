@extends('layouts.guest_master')

@section('styles')
    {{-- TODO: 각자의 페이지에서 일시적으로 필요한 스타일은 이곳에 넣습니다. --}}
@endsection

@section('content')
<div class="container pt-5">
        <div class="row justify-content-center">
       {{$name}}님, 관리자가 처리 후 답변드리겠습니다.
        </div>
   </div>
@endsection

@section('scripts')
    {{-- TODO: 각자의 페이지에서 일시적으로 필요한 스크립트는 이곳에 넣습니다 --}}
@endsection
