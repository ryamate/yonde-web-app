@extends('app')

@section('title', 'よんで')

@section('content')

@include('nav')

<div class="d-none d-md-block">
    @include('home.pc')
</div>

<div class="d-block d-md-none">
    @include('home.phone')
</div>

@include('footer')

@endsection
